<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopularDestinationSection;

class PopularDestinationSectionController extends Controller
{
    // Display all sections
    public function index()
    {
        $sections = PopularDestinationSection::with(['items' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->orderBy('order', 'asc')->get();

        return view('dashboard.home.popular-destination.index', compact('sections'));
    }


    // Store a new section
    public function store(Request $request)
    {
        $request->validate([
            'page_key' => 'nullable|string',
            'sub_heading' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        PopularDestinationSection::create([
            'page_key' => $request->page_key,
            'sub_heading' => $request->sub_heading,
            'heading' => $request->heading,
            'order' => $request->order ?? 1,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->back()->with('success', 'Popular Destination Section created successfully.');
    }

    public function update(Request $request, $id)
    {
        $section = PopularDestinationSection::findOrFail($id);

        $request->validate([
            'page_key' => 'required|string',
            'sub_heading' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $section->update([
            'page_key' => $request->page_key,
            'sub_heading' => $request->sub_heading,
            'heading' => $request->heading,
            'order' => $request->order ?? 1,
        ]);

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    public function destroy($id)
    {
        $section = PopularDestinationSection::findOrFail($id);
        $section->items()->delete(); // optional: delete items inside
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
}
