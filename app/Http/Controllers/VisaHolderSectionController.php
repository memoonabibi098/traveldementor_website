<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisaHolderSection;

class VisaHolderSectionController extends Controller
{
    /**
     * Show sections with items
     */
    public function index()
    {
        $sections = VisaHolderSection::with('items')
            ->orderBy('order')
            ->where('status', 1)
            ->get();

        return view('dashboard.home.visa-holder.index', compact('sections'));
    }

    /**
     * Store new section
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
            'status'      => 'required|in:0,1',
        ]);

        VisaHolderSection::create([
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => $request->order ?? 0,
            'status'      => $request->status,
        ]);

        return redirect()->back()->with('success', 'Section created successfully.');
    }

    public function update(Request $request, $id)
    {
        $section = VisaHolderSection::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
            'status'      => 'required|in:0,1',
        ]);

        $section->update([
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => $request->order ?? 0,
            'status'      => $request->status,
        ]);

        return back()->with('success', 'Section updated successfully.');
    }

    public function destroy($id)
    {
        VisaHolderSection::findOrFail($id)->delete();
        return back()->with('success', 'Section deleted');
    }
}
