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
}
