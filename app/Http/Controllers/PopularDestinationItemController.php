<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopularDestinationItem;
use App\Models\PopularDestinationSection;
use Illuminate\Support\Facades\File;

class PopularDestinationItemController extends Controller
{
    // Display all items (optional: you can filter by section)


    // Store a new destination item
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:popular_destination_sections,id',
            'image' => 'required|image|max:2048',
            'text' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_destination.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/popular-destination-items'), $imageName);
            $imagePath = 'uploads/popular-destination-items/' . $imageName;
        }

        PopularDestinationItem::create([
            'section_id' => $request->section_id,
            'image' => $imagePath,
            'text' => $request->text,
            'order' => $request->order ?? 1,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->back()->with('success', 'Popular Destination Item created successfully.');
    }

    public function update(Request $request, $id)
    {
        $item = PopularDestinationItem::findOrFail($id);

        $request->validate([
            'section_id' => 'required|exists:popular_destination_sections,id',
            'image' => 'nullable|image|max:2048',
            'text' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if (File::exists(public_path($item->image))) {
                File::delete(public_path($item->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_destination.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/popular-destination-items'), $imageName);
            $item->image = 'uploads/popular-destination-items/' . $imageName;
        }

        $item->section_id = $request->section_id;
        $item->text = $request->text;
        $item->order = $request->order ?? 1;
        $item->save();

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = PopularDestinationItem::findOrFail($id);

        // Delete image
        if (File::exists(public_path($item->image))) {
            File::delete(public_path($item->image));
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
