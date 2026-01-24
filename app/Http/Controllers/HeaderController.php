<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HeaderController extends Controller
{

    /**
     * Index Global Header
     */
    public function index()
    {
        // Get the first active header
        $header = Header::where('status', 1)->first();

        return view('dashboard.general.header.index', compact('header'));
    }



    /**
     * Store Global Header
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'menus'          => 'nullable|array',
            'menus.*.title'  => 'required_with:menus|string|max:100',
            'menus.*.url'    => 'required_with:menus|string|max:255',
            'button_text'    => 'nullable|string|max:100',
            'button_url'     => 'nullable|string|max:255',
            'status'         => 'required|boolean',
        ]);

        $data = $request->only([
            'menus',
            'button_text',
            'button_url',
            'status',
        ]);

        /** 🔹 Handle Logo Upload */
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Define upload path outside public
            $uploadPath = base_path('uploads/header');

            // Make sure the folder exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Delete old logo if exists
            $oldHeader = Header::first();
            if ($oldHeader && $oldHeader->logo && File::exists($uploadPath . '/' . $oldHeader->logo)) {
                File::delete($uploadPath . '/' . $oldHeader->logo);
            }

            // Move file to the base_path folder
            $file->move($uploadPath, $fileName);

            $data['logo'] = $fileName; // just store filename in DB
        }

        /** 🔹 Single Header Enforcement */
        Header::updateOrCreate(
            ['id' => 1], // always update same row
            $data
        );

        return redirect()->route('admin.header')
            ->with('success', 'Header saved successfully');
    }



    /**
     * Update existing header
     */
    public function update(Request $request, $id)
    {
        $header = Header::findOrFail($id);

        $request->validate([
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'menus' => 'nullable|array',
            'menus.*.title' => 'required_with:menus|string|max:100',
            'menus.*.url' => 'required_with:menus|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['menus', 'button_text', 'button_url', 'status']);

        /** Handle logo */
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Delete old logo
            if ($header->logo && File::exists(public_path('uploads/header/' . $header->logo))) {
                File::delete(public_path('uploads/header/' . $header->logo));
            }

            // Move new file
            $file->move(public_path('uploads/header'), $fileName);

            $data['logo'] = $fileName;
        }


        if (isset($data['menus'])) {
            $data['menus'] = json_encode($data['menus']);
        }

        $header->update($data);

        return redirect()->back()->with('success', 'Header updated successfully.');
    }

    /**
     * Delete header
     */
    public function destroy($id)
    {
        $header = Header::findOrFail($id);

        if ($header->logo && File::exists(public_path('uploads/' . $header->logo))) {
            File::delete(public_path('uploads/' . $header->logo));
        }

        $header->delete();

        return redirect()->back()->with('success', 'Header deleted successfully.');
    }
}
