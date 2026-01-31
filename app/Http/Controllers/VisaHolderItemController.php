<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisaHolderItem;
use Illuminate\Support\Str;

class VisaHolderItemController extends Controller
{
    /**
     * Store new item
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_id'  => 'required|exists:visa_holder_sections,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order'       => 'nullable|integer',
            'status'      => 'required|in:0,1',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {

            // Destination folder
            $destinationPath = public_path('uploads/visa_holder_items');

            // Create folder if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Unique file name
            $imageName = time() . '_' . Str::random(10) . '.' .
                $request->image->getClientOriginalExtension();

            // Move image
            $request->image->move($destinationPath, $imageName);

            // Save relative path in DB
            $imagePath = 'uploads/visa_holder_items/' . $imageName;
        }

        VisaHolderItem::create([
            'section_id'  => $request->section_id,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
            'order'       => $request->order ?? 0,
            'status'      => $request->status,
        ]);

        return redirect()->back()->with('success', 'Item created successfully.');
    }

    public function update(Request $request, $id)
    {
        $item = VisaHolderItem::findOrFail($id);

        $request->validate([
            'section_id'  => 'required|exists:visa_holder_sections,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order'       => 'nullable|integer',
            'status'      => 'required|in:0,1',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {

            // Delete old image if exists
            if ($item->image && file_exists(public_path($item->image))) {
                unlink(public_path($item->image));
            }

            // Destination folder
            $destinationPath = public_path('uploads/visa_holder_items');

            // Create folder if not exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Unique file name
            $imageName = time() . '_' . Str::random(10) . '.' . $request->image->getClientOriginalExtension();

            // Move image
            $request->image->move($destinationPath, $imageName);

            // Save relative path in DB
            $item->image = 'uploads/visa_holder_items/' . $imageName;
        }

        // Update other fields
        $item->section_id  = $request->section_id;
        $item->title       = $request->title;
        $item->description = $request->description;
        $item->order       = $request->order ?? 0;
        $item->status      = $request->status;

        $item->save();

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        VisaHolderItem::findOrFail($id)->delete();
        return back()->with('success', 'Item deleted');
    }
}
