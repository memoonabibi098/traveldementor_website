<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChooseUsPoint;
use App\Models\ChooseUsSection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ChooseUsController extends Controller
{
    /**
     * Display all Choose Us sections.
     */
    public function index()
    {
        $sections = ChooseUsSection::with('points')->orderBy('id', 'desc')->get();
        return view('dashboard.home.choose-us.index', compact('sections'));
    }

    /**
     * Store a new Choose Us section with points.
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_key' => 'required|string',
            'heading' => 'required|string',
            'description' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'points.*.heading' => 'required|string',
            'points.*.description' => 'required|string',
            'points.*.icon' => 'nullable|image|max:2048',
        ]);

        // Upload main image if exists
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_main.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('uploads/chooseussection/main_images'), $mainImageName);
            $mainImagePath = 'uploads/chooseussection/main_images/' . $mainImageName;
        }

        // Create main section
        $section = ChooseUsSection::create([
            'page_key' => $request->page_key,
            'heading' => $request->heading,
            'description' => $request->description,
            'main_image' => $mainImagePath,
            'status' => 1,
        ]);

        // Create points
        if ($request->has('points')) {
            foreach ($request->points as $index => $point) {
                $iconPath = null;
                if (isset($point['icon']) && $point['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $icon = $point['icon'];
                    $iconName = time() . '_point' . $index . '.' . $icon->getClientOriginalExtension();
                    $icon->move(public_path('uploads/chooseussection/points'), $iconName);
                    $iconPath = 'uploads/chooseussection/points/' . $iconName;
                }

                ChooseUsPoint::create([
                    'section_id' => $section->id,
                    'icon_image' => $iconPath,
                    'heading' => $point['heading'],
                    'description' => $point['description'],
                    'order' => $point['order'], // use order from input
                    'status' => 1,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Choose Us section created successfully.');
    }


    public function update(Request $request, $id)
    {
        $section = ChooseUsSection::with('points')->findOrFail($id);

        $request->validate([
            'page_key' => 'required|string',
            'heading' => 'required|string',
            'description' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'points.*.heading' => 'required|string',
            'points.*.description' => 'required|string',
            'points.*.icon' => 'nullable|image|max:2048',
            'points.*.order' => 'required|integer',
        ]);

        // Update main image
        if ($request->hasFile('main_image')) {
            if ($section->main_image && File::exists(public_path($section->main_image))) {
                File::delete(public_path($section->main_image));
            }
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_main.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('uploads/chooseussection'), $mainImageName);
            $section->main_image = 'uploads/chooseussection/' . $mainImageName;
        }

        $section->page_key = $request->page_key;
        $section->heading = $request->heading;
        $section->description = $request->description;
        $section->save();

        // Keep track of point IDs to delete removed ones
        $existingPointIds = $section->points->pluck('id')->toArray();
        $submittedPointIds = [];

        if ($request->has('points')) {
            foreach ($request->points as $point) {
                // Update existing point
                if (!empty($point['id'])) {
                    $submittedPointIds[] = $point['id'];
                    $existingPoint = ChooseUsPoint::find($point['id']);
                    $existingPoint->heading = $point['heading'];
                    $existingPoint->description = $point['description'];
                    $existingPoint->order = $point['order'];

                    // Update icon if new file uploaded
                    if (isset($point['icon']) && $point['icon'] instanceof \Illuminate\Http\UploadedFile) {
                        // Delete old icon
                        if ($existingPoint->icon_image && File::exists(public_path($existingPoint->icon_image))) {
                            File::delete(public_path($existingPoint->icon_image));
                        }
                        $iconFile = $point['icon'];
                        $iconName = time() . '_point' . $point['id'] . '.' . $iconFile->getClientOriginalExtension();
                        $iconFile->move(public_path('uploads/chooseussection/points'), $iconName);
                        $existingPoint->icon_image = 'uploads/chooseussection/points/' . $iconName;
                    }

                    $existingPoint->save();
                } else {
                    // Create new point
                    $iconPath = null;
                    if (isset($point['icon']) && $point['icon'] instanceof \Illuminate\Http\UploadedFile) {
                        $iconFile = $point['icon'];
                        $iconName = time() . '_point_new.' . $iconFile->getClientOriginalExtension();
                        $iconFile->move(public_path('uploads/chooseussection/points'), $iconName);
                        $iconPath = 'uploads/chooseussection/points/' . $iconName;
                    }

                    ChooseUsPoint::create([
                        'section_id' => $section->id,
                        'icon_image' => $iconPath,
                        'heading' => $point['heading'],
                        'description' => $point['description'],
                        'order' => $point['order'] ?? 1,
                        'status' => 1,
                    ]);
                }
            }
        }

        // Delete points that were removed in the form
        $pointsToDelete = array_diff($existingPointIds, $submittedPointIds);
        if (!empty($pointsToDelete)) {
            foreach ($pointsToDelete as $pointId) {
                $point = ChooseUsPoint::find($pointId);
                if ($point) {
                    // Delete icon file
                    if ($point->icon_image && File::exists(public_path($point->icon_image))) {
                        File::delete(public_path($point->icon_image));
                    }
                    $point->delete();
                }
            }
        }

        return redirect()->route('admin.choose-us.index')->with('success', 'Choose Us section updated successfully.');
    }


    // Delete section
    public function destroy($id)
    {
        $section = ChooseUsSection::findOrFail($id);
        $section->delete(); // soft delete
        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
}
