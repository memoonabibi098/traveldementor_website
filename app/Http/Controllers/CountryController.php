<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::latest()->get();
        return view('dashboard.additionalrecords.countries.index', compact('countries'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.additionalrecords.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name'      => 'required|string|max:255',
            'urdu_name' => 'required|string|max:255',
            'code'      => 'required|string|max:3|unique:countries,code',
            'img'       => 'required|image|mimes:jpeg,png,jpg,webp',
        ]);

        $path = null;

        if ($request->hasFile('img')) {

            $image    = $request->file('img');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Path: public/uploads/countries/
            $uploadsPath = public_path('uploads/countries');

            // Create uploads folder if not exists
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0777, true);
            }

            // Create countries folder if not exists
            if (!file_exists($uploadsPath)) {
                mkdir($uploadsPath, 0777, true);
            }

            // Move file
            $image->move($uploadsPath, $filename);

            // Save relative path for DB
            $path = 'uploads/countries/' . $filename;
        }

        // Save to DB
        Country::create([
            'name'      => $request->name,
            'urdu_name' => $request->urdu_name,
            'code'      => strtoupper($request->code),
            'img'       => $path,  // Example: uploads/countries/abc123.png
        ]);

        return redirect()->route('countries.index')
            ->with('success', 'Country created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $country = Country::findOrFail($id);
        return view('dashboard.additionalrecords.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('dashboard.additionalrecords.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        // Validation
        $request->validate([
            'name'      => 'required|string|max:255',
            'urdu_name' => 'required|string|max:255',
            'code'      => 'required|string|max:3|unique:countries,code,' . $country->id,
            'img'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $country->img; // keep existing image unless replaced

        if ($request->hasFile('img')) {

            $image    = $request->file('img');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Folder path: public/uploads/countries
            $uploadsPath = public_path('uploads/countries');

            // Create uploads folder if missing
            if (!file_exists(public_path('uploads'))) {
                mkdir(public_path('uploads'), 0777, true);
            }

            // Create countries folder if missing
            if (!file_exists($uploadsPath)) {
                mkdir($uploadsPath, 0777, true);
            }

            // Delete old image if exists
            if ($country->img && file_exists(public_path($country->img))) {
                unlink(public_path($country->img));
            }

            // uploads new image
            $image->move($uploadsPath, $filename);

            // Save new path
            $path = 'uploads/countries/' . $filename;
        }

        // Update DB
        $country->update([
            'name'      => $request->name,
            'urdu_name' => $request->urdu_name,
            'code'      => strtoupper($request->code),
            'img'       => $path,
        ]);

        return redirect()->route('countries.index')
            ->with('success', 'Country updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('countries.index')
            ->with('success', 'Country deleted successfully.');
    }
}
