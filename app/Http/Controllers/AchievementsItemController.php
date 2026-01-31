<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AchievementsItem;

class AchievementsItemController extends Controller
{
    // Store new item
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:achievements_sections,id',
            'icon' => 'required|string|max:100',
            'number' => 'required|string|max:50',
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        AchievementsItem::create([
            'section_id' => $request->section_id,
            'icon' => $request->icon,
            'number' => $request->number,
            'heading' => $request->heading,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Item created successfully.');
    }

    public function update(Request $request, $id)
    {
        $item = AchievementsItem::findOrFail($id);

        $item->section_id = $request->section_id;
        $item->icon = $request->icon;
        $item->number = $request->number;
        $item->heading = $request->heading;
        $item->description = $request->description;
        $item->order = $request->order;
        $item->status = $request->status;

        $item->save();

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    public function destroy($id)
    {
        $item = AchievementsItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
