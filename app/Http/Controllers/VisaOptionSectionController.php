<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisaOptionSection;

class VisaOptionSectionController extends Controller
{
    /**
     * Display Visa Option Sections with Items
     */
    public function index()
    {
        $sections = VisaOptionSection::with('items')
            ->orderBy('order', 'asc')
            ->get();

        return view('dashboard.home.visa-options.index', compact('sections'));
    }

    /**
     * Store a new Visa Option Section
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_key'     => 'nullable|string|max:255',
            'heading'      => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'required|in:0,1',
            'order'        => 'nullable|integer',
        ]);

        VisaOptionSection::create([
            'page_key'    => $request->page_key,
            'heading'     => $request->heading,
            'description' => $request->description,
            'status'      => $request->status,
            'order'       => $request->order ?? 1,
        ]);

        return redirect()->back()->with('success', 'Visa Option Section created successfully.');
    }

    public function update(Request $request, $id)
    {
        $section = VisaOptionSection::findOrFail($id);

        $section->update($request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
            'order' => 'nullable|integer',
        ]));

        return back()->with('success', 'Section updated');
    }

    public function destroy($id)
    {
        VisaOptionSection::findOrFail($id)->delete();
        return back()->with('success', 'Section deleted');
    }
}
