<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Header;
use App\Models\Country;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function indexHome()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header && $header->menus ? json_decode($header->menus, true) : [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : []; // No json_decode needed
        // countries
        $countries = Country::orderBy('name', 'asc')->get();
        // hero sections
        $heroSection = HeroSection::with(['repeaters.fields'])
            ->where('status', 1)
            ->where('page_key', 'home')
            ->first();


        return view('website.home', compact('header', 'menus', 'footer', 'companyLinks', 'countries', 'heroSection'));
    }


    public function indexAbout()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header && $header->menus ? json_decode($header->menus, true) : [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : []; // No json_decode needed
        // hero sections
        $heroSection = HeroSection::with(['repeaters.fields'])
            ->where('status', 1)
            ->where('page_key', 'about')
            ->first();


        return view('website.about-us', compact('header', 'menus', 'footer', 'companyLinks', 'heroSection'));
    }
}
