<?php

namespace App\Http\Controllers;

use App\Models\HeroRepeater;
use App\Models\HeroRepeaterField;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroes = HeroSection::with(['repeaters.fields'])
            ->orderBy('page_key')
            ->get()
            ->groupBy('page_key');

        return view('dashboard.general.hero.index', compact('heroes'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $hero = HeroSection::updateOrCreate(
                ['page_key' => $request->page_key],
                [
                    'tag' => $request->tag,
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => true,
                ]
            );

            // Handle images
            if ($request->hasFile('primary_image')) {
                $hero->primary_image = $this->uploadImage(
                    $request->file('primary_image'),
                    $request->page_key
                );
            }

            if ($request->hasFile('secondary_image')) {
                $hero->secondary_image = $this->uploadImage(
                    $request->file('secondary_image'),
                    $request->page_key
                );
            }

            $hero->save();

            // Reset repeaters
            $hero->repeaters()->delete();

            // Dynamic repeaters
            foreach ($request->all() as $type => $rows) {
                if (! is_array($rows)) {
                    continue;
                }

                foreach ($rows as $index => $fields) {
                    if (! is_array($fields)) {
                        continue;
                    }

                    $repeater = HeroRepeater::create([
                        'hero_section_id' => $hero->id,
                        'type' => $type,
                        'sort_order' => $index,
                    ]);

                    foreach ($fields as $fieldKey => $fieldValue) {
                        if ($request->hasFile("$type.$index.$fieldKey")) {
                            $fieldValue = $this->uploadImage(
                                $request->file("$type.$index.$fieldKey"),
                                $request->page_key . '/' . $type
                            );
                        }

                        HeroRepeaterField::create([
                            'hero_repeater_id' => $repeater->id,
                            'field_key' => $fieldKey,
                            'field_value' => $fieldValue,
                        ]);
                    }
                }
            }
        });

        return back()->with('success', 'Hero section saved successfully.');
    }

    /**
     * Helper to store uploaded file in public/uploads/hero/{page} folder
     */
    private function uploadImage($file, $folder)
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path("uploads/hero/$folder"), $filename);

        return "uploads/hero/$folder/$filename";
    }

    public function editJson($id)
    {
        $hero = HeroSection::with('repeaters.fields')->findOrFail($id);

        $response = [
            'tag' => $hero->tag,
            'title' => $hero->title,
            'description' => $hero->description,
            'primary_image' => $hero->primary_image ? asset($hero->primary_image) : null,
            'secondary_image' => $hero->secondary_image ? asset($hero->secondary_image) : null,
        ];

        // Add repeaters dynamically
        foreach ($hero->repeaters as $repeater) {
            $repeaterData = [];
            foreach ($repeater->fields as $field) {
                $repeaterData[$field->field_key] = $field->field_value;
            }
            $response[$repeater->type][] = $repeaterData;
        }

        // Convert picture paths in repeaters to full URLs
        foreach ($response as $key => $value) {
            if (is_array($value)) {
                $response[$key] = array_map(function ($item) {
                    if (isset($item['picture']) && $item['picture']) {
                        $item['picture'] = asset($item['picture']); // use public path
                    }

                    return $item;
                }, $value);
            }
        }

        return response()->json($response);
    }

    public function update(Request $request, HeroSection $hero)
    {
        DB::transaction(function () use ($request, $hero) {

            // Update basic fields
            $hero->update([
                'tag' => $request->tag,
                'title' => $request->title,
                'description' => $request->description,
                'status' => true,
            ]);

            // Handle main images
            if ($request->hasFile('primary_image')) {
                $hero->primary_image = $this->uploadImage($request->file('primary_image'), $request->page_key);
            }

            if ($request->hasFile('secondary_image')) {
                $hero->secondary_image = $this->uploadImage($request->file('secondary_image'), $request->page_key);
            }

            $hero->save();

            // Remove old repeaters
            $hero->repeaters()->delete();

            // Handle repeater images and fields
            foreach ($request->all() as $type => $rows) {
                if (!is_array($rows)) continue;

                foreach ($rows as $index => $fields) {
                    if (!is_array($fields)) continue;

                    $repeater = HeroRepeater::create([
                        'hero_section_id' => $hero->id,
                        'type' => $type,
                        'sort_order' => $index,
                    ]);

                    foreach ($fields as $fieldKey => $fieldValue) {

                        // Handle repeater file uploads using public path
                        if ($request->hasFile("$type.$index.$fieldKey")) {
                            $fieldValue = $this->uploadImage(
                                $request->file("$type.$index.$fieldKey"),
                                $request->page_key . '/' . $type
                            );
                        }

                        HeroRepeaterField::create([
                            'hero_repeater_id' => $repeater->id,
                            'field_key' => $fieldKey,
                            'field_value' => $fieldValue,
                        ]);
                    }
                }
            }
        });

        return redirect()->back()->with('success', 'Hero section updated successfully.');
    }


    public function destroy(HeroSection $hero)
    {
        DB::transaction(function () use ($hero) {
            $hero->repeaters()->delete();
            $hero->delete();
        });

        return redirect()->back()->with('success', 'Hero section deleted successfully.');
    }
}
