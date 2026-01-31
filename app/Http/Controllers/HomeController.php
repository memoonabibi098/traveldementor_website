<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Header;
use App\Models\Country;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use App\Models\ChooseUsSection;
use App\Models\VisaHolderSection;
use App\Models\VisaOptionSection;
use App\Models\PopularDestinationSection;

class HomeController extends Controller
{
    //
    public function indexHome()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header->menus ?? [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : [];

        // Countries
        $countries = Country::orderBy('name', 'asc')->get();

        // Hero sections
        $heroSection = HeroSection::with(['repeaters.fields'])
            ->where('status', 1)
            ->where('page_key', 'home')
            ->first();

        // **Choose Us sections with points**
        $chooseUsSections = ChooseUsSection::with('points')
            ->where('status', 1)
            ->where('page_key', 'home') // optional if you have multiple pages
            ->get();

        // Optional: get main heading/description from the first section
        $chooseUsMain = $chooseUsSections->first();


        // Fetch active popular destinations with items
        $popularDestinationsSections = PopularDestinationSection::with(['items' => function ($q) {
            $q->where('status', 1)->orderBy('order', 'asc');
        }])
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();

        // Visa Options (Home Page)
        $visaOptionSections = VisaOptionSection::with([
            'items' => function ($q) {
                $q->where('status', 1)
                    ->orderBy('order', 'asc')
                    ->with(['counters' => function ($c) {
                        $c->orderBy('order', 'asc');
                    }]);
            }
        ])
            ->where('status', 1)
            ->where('page_key', 'home')
            ->orderBy('order', 'asc')
            ->get();
        // Visa Options for Home (Flatten for design)
        $visaOptions = collect();

        $visaOptionMainHeading = null;

        if ($visaOptionSections->isNotEmpty()) {
            $visaOptionMainHeading = $visaOptionSections->first()->heading;

            foreach ($visaOptionSections->first()->items as $item) {
                $applyCounter = $item->counters->firstWhere('label', 'Apply');
                $approvedCounter = $item->counters->firstWhere('label', 'Approved');

                $visaOptions->push((object) [
                    'icon' => asset($item->image),
                    'title' => $item->title,
                    'description' => $item->description,
                    'apply_count' => $applyCounter?->value ?? 0,
                    'approved_percentage' => $approvedCounter?->value ?? 0,
                ]);
            }
        }

        // Fetch active Visa Holder Sections with their active items
        $visaHolderSections = VisaHolderSection::with(['items' => function ($q) {
            $q->where('status', 1)->orderBy('order', 'asc');
        }])
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();


        return view('website.home', compact(
            'header',
            'menus',
            'footer',
            'companyLinks',
            'countries',
            'heroSection',
            'chooseUsSections',
            'chooseUsMain',
            'popularDestinationsSections',
            'visaOptionSections',
            'visaOptionMainHeading',
            'visaOptions',
            'visaHolderSections'
        ));
    }


    public function indexAbout()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header->menus ?? [];

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

    public function indexService()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header->menus ?? [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : []; // No json_decode needed
        // hero sections
        $heroSection = HeroSection::with(['repeaters.fields'])
            ->where('status', 1)
            ->where('page_key', 'services')
            ->first();


        return view('website.services', compact('header', 'menus', 'footer', 'companyLinks', 'heroSection'));
    }

    public function indexTracking()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header->menus ?? [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : []; // No json_decode needed
        // hero sections
        $heroSection = HeroSection::with(['repeaters.fields'])
            ->where('status', 1)
            ->where('page_key', 'visa_status')
            ->first();


        return view('website.visastatus', compact('header', 'menus', 'footer', 'companyLinks', 'heroSection'));
    }

    public function indexFaq()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header->menus ?? [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : []; // No json_decode needed
        // hero sections
        $heroSection = HeroSection::with(['repeaters.fields'])
            ->where('status', 1)
            ->where('page_key', 'faqs')
            ->first();


        return view('website.faqs', compact('header', 'menus', 'footer', 'companyLinks', 'heroSection'));
    }

    public function indexContact()
    {
        // Fetch active header
        $header = Header::where('status', 1)->first();
        $menus = $header->menus ?? [];

        // Fetch active footer
        $footer = Footer::where('status', 1)->first();
        $companyLinks = $footer ? $footer->company_links ?? [] : []; // No json_decode needed
        // hero sections
        $heroSection = HeroSection::with(['repeaters.fields'])
            ->where('status', 1)
            ->where('page_key', 'contact')
            ->first();


        return view('website.contact-us', compact('header', 'menus', 'footer', 'companyLinks', 'heroSection'));
    }
}
