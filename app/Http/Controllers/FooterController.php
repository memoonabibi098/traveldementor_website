<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Show footer page (Admin)
     */
    public function index()
    {
        // Single global footer
        $footer = Footer::latest()->first();

        return view('dashboard.general.footer.index', compact('footer'));
    }

    /**
     * Store footer
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'logo'              => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'intro_text'        => 'nullable|string',
            'newsletter_text'   => 'nullable|string',

            'company_links'               => 'nullable|array',
            'company_links.*.title'       => 'nullable|string',
            'company_links.*.url'         => 'nullable|string',

            'phone'             => 'nullable|string',
            'email'             => 'nullable|email',
            'address'           => 'nullable|string',

            'facebook'          => 'nullable|string',
            'instagram'         => 'nullable|string',
            'mail'              => 'nullable|string',
            'linkedin'          => 'nullable|string',
            'youtube'           => 'nullable|string',

            'copyright_text'    => 'nullable|string',
            'status'            => 'required|boolean',
        ]);

        // Upload logo
        if ($request->hasFile('logo')) {
            $filename = time() . '_' . $request->logo->getClientOriginalName();
            $request->logo->move(public_path('uploads/footer'), $filename);
            $data['logo'] = $filename; // no 'footer/' prefix

        }

        Footer::create($data);

        return redirect()->back()->with('success', 'Footer created successfully.');
    }

    /**
     * Update footer
     */
    public function update(Request $request, $id)
    {
        $footer = Footer::findOrFail($id);

        $data = $request->validate([
            'logo'              => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'intro_text'        => 'nullable|string',
            'newsletter_text'   => 'nullable|string',

            'company_links'               => 'nullable|array',
            'company_links.*.title'       => 'nullable|string',
            'company_links.*.url'         => 'nullable|string',

            'phone'             => 'nullable|string',
            'email'             => 'nullable|email',
            'address'           => 'nullable|string',

            'facebook'          => 'nullable|string',
            'instagram'         => 'nullable|string',
            'mail'              => 'nullable|string',
            'linkedin'          => 'nullable|string',
            'youtube'           => 'nullable|string',

            'copyright_text'    => 'nullable|string',
            'status'            => 'required|boolean',
        ]);

        // Update logo
        if ($request->hasFile('logo')) {
            if ($footer->logo && file_exists(public_path('uploads/' . $footer->logo))) {
                unlink(public_path('uploads/' . $footer->logo));
            }

            $filename = time() . '_' . $request->logo->getClientOriginalName();
            $request->logo->move(public_path('uploads/footer'), $filename);
            $data['logo'] = $filename; // only filename
        }

        $footer->update($data);

        return redirect()->back()->with('success', 'Footer updated successfully.');
    }

    /**
     * Delete footer
     */
    public function destroy($id)
    {
        $footer = Footer::findOrFail($id);

        if ($footer->logo && file_exists(public_path('uploads/' . $footer->logo))) {
            unlink(public_path('uploads/' . $footer->logo));
        }

        $footer->delete();

        return redirect()->back()->with('success', 'Footer deleted successfully.');
    }
}
