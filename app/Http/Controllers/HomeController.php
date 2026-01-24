<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Header;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header && $header->menus ? json_decode($header->menus, true) : [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : []; // No json_decode needed

        return view('website.home', compact('header', 'menus', 'footer', 'companyLinks'));
    }
}
