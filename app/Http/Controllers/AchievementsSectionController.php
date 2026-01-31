<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AchievementsSection;

class AchievementsSectionController extends Controller
{
    // Display all sections
    public function index()
    {
        $sections = AchievementsSection::with('items')->orderBy('order', 'asc')->get();
        return view('dashboard.home.our-achievements.index', compact('sections'));
    }

    // Store new section
    public function store(Request $request)
    {
        $request->validate([
            'main_heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/achievements_sections');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $imageName);
            $imagePath = 'uploads/achievements_sections/' . $imageName;
        }

        AchievementsSection::create([
            'main_heading' => $request->main_heading,
            'description' => $request->description,
            'image' => $imagePath,
            'order' => $request->order ?? 0,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Section created successfully.');
    }


    public function update(Request $request, $id)
    {
        $section = AchievementsSection::findOrFail($id);

        $section->main_heading = $request->main_heading;
        $section->description = $request->description;
        $section->order = $request->order;
        $section->status = $request->status;

        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/achievements_sections');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $imageName);
            $section->image = 'uploads/achievements_sections/' . $imageName;
        }

        $section->save();

        return redirect()->back()->with('success', 'Section updated successfully.');
    }


    public function destroy($id)
    {
        $section = AchievementsSection::findOrFail($id);
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
}
