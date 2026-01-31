<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisaOptionItem;
use App\Models\VisaOptionCounter;
use Illuminate\Support\Facades\DB;

class VisaOptionItemController extends Controller
{
    /**
     * Store a new Visa Option Item
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:visa_option_sections,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:0,1',
            'order' => 'nullable|integer',

            'counters' => 'required|array|min:1',
            'counters.*.value' => 'required|integer',
            'counters.*.suffix' => 'nullable|string|max:10',
            'counters.*.label' => 'nullable|string|max:255',
            'counters.*.order' => 'nullable|integer',
        ]);

        // Image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_visa_option.' . $request->image->extension();
            $request->image->move(public_path('uploads/visa-options'), $imageName);
            $imagePath = 'uploads/visa-options/' . $imageName;
        }

        // Create Item
        $item = VisaOptionItem::create([
            'section_id' => $request->section_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
            'order' => $request->order ?? 1,
        ]);

        // Create Counters
        foreach ($request->counters as $counter) {
            $item->counters()->create([
                'value' => $counter['value'],
                'suffix' => $counter['suffix'] ?? null,
                'label' => $counter['label'] ?? null,
                'order' => $counter['order'] ?? 1,
            ]);
        }

        return redirect()->back()->with('success', 'Visa Option Item created successfully.');
    }

    public function update(Request $request, $id)
    {
        $item = VisaOptionItem::with('counters')->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'order' => 'nullable|integer',

            'counters' => 'required|array|min:1',
            'counters.*.id' => 'nullable|exists:visa_option_counters,id',
            'counters.*.value' => 'required|integer',
            'counters.*.suffix' => 'nullable|string|max:10',
            'counters.*.label' => 'nullable|string|max:255',
            'counters.*.order' => 'nullable|integer',
        ]);

        DB::transaction(function () use ($request, $item, $validated) {

            /* --------------------
           Update Item
        -------------------- */
            if ($request->hasFile('image')) {
                $imageName = time() . '_visa_option.' . $request->image->extension();
                $request->image->move(public_path('uploads/visa-options'), $imageName);
                $item->image = 'uploads/visa-options/' . $imageName;
            }

            $item->update([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'status' => $validated['status'],
                'order' => $validated['order'] ?? 1,
            ]);

            /* --------------------
           Sync Counters
        -------------------- */

            $existingIds = $item->counters->pluck('id')->toArray();
            $submittedIds = [];

            foreach ($validated['counters'] as $counterData) {

                // UPDATE existing counter
                if (!empty($counterData['id'])) {
                    $counter = VisaOptionCounter::find($counterData['id']);

                    if ($counter) {
                        $counter->update([
                            'value' => $counterData['value'],
                            'suffix' => $counterData['suffix'] ?? null,
                            'label' => $counterData['label'] ?? null,
                            'order' => $counterData['order'] ?? 1,
                        ]);

                        $submittedIds[] = $counter->id;
                    }
                } else {
                    // CREATE new counter
                    $newCounter = $item->counters()->create([
                        'value' => $counterData['value'],
                        'suffix' => $counterData['suffix'] ?? null,
                        'label' => $counterData['label'] ?? null,
                        'order' => $counterData['order'] ?? 1,
                    ]);

                    $submittedIds[] = $newCounter->id;
                }
            }

            /* --------------------
           DELETE removed counters
        -------------------- */
            $toDelete = array_diff($existingIds, $submittedIds);

            if (!empty($toDelete)) {
                VisaOptionCounter::whereIn('id', $toDelete)->delete();
            }
        });

        return back()->with('success', 'Visa Option updated successfully.');
    }


    public function destroy($id)
    {
        VisaOptionItem::findOrFail($id)->delete();
        return back()->with('success', 'Item deleted');
    }
}
