<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ChooseUsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\VisaHolderItemController;
use App\Http\Controllers\VisaOptionItemController;
use App\Http\Controllers\AchievementsItemController;
use App\Http\Controllers\VisaHolderSectionController;
use App\Http\Controllers\VisaOptionSectionController;
use App\Http\Controllers\PopularDestinationController;
use App\Http\Controllers\AchievementsSectionController;
use App\Http\Controllers\PopularDestinationItemController;
use App\Http\Controllers\PopularDestinationSectionController;



// ..........................................................Website Portion........................................................


Route::get('/', [HomeController::class, 'indexHome'])->name('homepage');
Route::get('/aboutus', [HomeController::class, 'indexAbout'])->name('aboutpage');
Route::get('/services', [HomeController::class, 'indexService'])->name('servicepage');
Route::get('/visastatus', [HomeController::class, 'indexTracking'])->name('trackingpage');
Route::get('/faqs', [HomeController::class, 'indexFaq'])->name('faqpage');
Route::get('/contactus', [HomeController::class, 'indexContact'])->name('contactpage');






















// ..........................................................Dashboard Portion........................................................


Route::middleware('admin.auth')->group(function () {

    Route::get('admin/dashboard', function () {
        return view('dashboard.app');
    })->name('admin.dashboard');

    Route::get('/header', [HeaderController::class, 'index'])->name('admin.header');
    Route::post('/dashboard/header/store', [HeaderController::class, 'store'])->name('header.store');
    Route::put('/header/update/{id}', [HeaderController::class, 'update'])->name('header.update');
    Route::delete('/header/destroy/{id}', [HeaderController::class, 'destroy'])->name('header.destroy');
    Route::get('/footer', [FooterController::class, 'index'])->name('admin.footer');
    Route::post('/footer', [FooterController::class, 'store'])->name('footer.store');
    Route::put('/footer/{id}', [FooterController::class, 'update'])->name('footer.update');
    Route::delete('/footer/{id}', [FooterController::class, 'destroy'])->name('footer.destroy');
    Route::get('/hero', [HeroSectionController::class, 'index'])->name('admin.hero');
    Route::post('/hero', [HeroSectionController::class, 'store'])->name('hero.store');
    Route::get('/hero/{hero}/edit-json', [HeroSectionController::class, 'editJson'])->name('hero.edit');
    Route::put('hero/{hero}', [HeroSectionController::class, 'update'])->name('hero.update');
    Route::delete('hero/{hero}', [HeroSectionController::class, 'destroy'])->name('hero.destroy');
    Route::get('choose-us', [ChooseUsController::class, 'index'])->name('admin.choose-us.index');
    Route::post('choose-us', [ChooseUsController::class, 'store'])->name('choose-us.store');
    Route::put('choose-us/{id}', [ChooseUsController::class, 'update'])->name('choose-us.update');
    Route::delete('choose-us/{id}', [ChooseUsController::class, 'destroy'])->name('choose-us.destroy');
    Route::get('popular-destination', [PopularDestinationSectionController::class, 'index'])->name('admin.popular-destination-section.index');
    Route::post('popular-destination/sections', [PopularDestinationSectionController::class, 'store'])->name('popular-destination-section.store');
    Route::post('popular-destination/items', [PopularDestinationItemController::class, 'store'])->name('popular-destination-item.store');
    Route::put('popular-destination-section/{id}', [PopularDestinationSectionController::class, 'update'])->name('popular-destination-section.update');
    Route::delete('popular-destination-section/{id}', [PopularDestinationSectionController::class, 'destroy'])->name('popular-destination-section.destroy');
    Route::put('popular-destination-item/{id}', [PopularDestinationItemController::class, 'update'])->name('popular-destination-item.update');
    Route::delete('popular-destination-item/{id}', [PopularDestinationItemController::class, 'destroy'])->name('popular-destination-item.destroy');
    Route::get('/visa-options', [VisaOptionSectionController::class, 'index'])->name('admin.visa-options.index');
    Route::post('/visa-options/section/store', [VisaOptionSectionController::class, 'store'])->name('visa-options.section.store');
    Route::post('/visa-options/item/store', [VisaOptionItemController::class, 'store'])->name('visa-options.item.store');
    Route::put('visa-options/section/{id}', [VisaOptionSectionController::class, 'update'])->name('visa-options.section.update');
    Route::delete('visa-options/section/{id}', [VisaOptionSectionController::class, 'destroy'])->name('visa-options.section.destroy');
    Route::put('visa-options/item/{id}', [VisaOptionItemController::class, 'update'])->name('visa-options.item.update');
    Route::delete('visa-options/item/{id}', [VisaOptionItemController::class, 'destroy'])->name('visa-options.item.destroy');
    Route::get('/visa-holder', [VisaHolderSectionController::class, 'index'])->name('admin.visa-holder.index');
    Route::post('/visa-holder/section/store', [VisaHolderSectionController::class, 'store'])->name('visa-holder-section.store');
    Route::put('/visa-holder/section/update/{id}', [VisaHolderSectionController::class, 'update'])->name('visa-holder-section.update');
    Route::delete('/visa-holder/section/destroy/{id}', [VisaHolderSectionController::class, 'destroy'])->name('visa-holder-section.destroy');
    Route::post('/visa-holder/item/store', [VisaHolderItemController::class, 'store'])->name('visa-holder-item.store');
    Route::put('/visa-holder/item/update/{id}', [VisaHolderItemController::class, 'update'])->name('visa-holder-item.update');
    Route::delete('/visa-holder/item/destroy/{id}', [VisaHolderItemController::class, 'destroy'])->name('visa-holder-item.destroy');
    Route::get('/our-achievements', [AchievementsSectionController::class, 'index'])->name('admin.our-achievements.section.index');
    Route::post('/our-achievements/section/store', [AchievementsSectionController::class, 'store'])->name('our-achievements.section.store');
    Route::put('/our-achievements/section/update/{id}', [AchievementsSectionController::class, 'update'])->name('our-achievements.section.update');
    Route::delete('/our-achievements/section/destroy/{id}', [AchievementsSectionController::class, 'destroy'])->name('our-achievements.section.destroy');
    Route::post('/our-achievements/item/store', [AchievementsItemController::class, 'store'])->name('our-achievements.item.store');
    Route::put('/our-achievements/item/update/{id}', [AchievementsItemController::class, 'update'])->name('our-achievements.item.update');
    Route::delete('/our-achievements/item/destroy/{id}', [AchievementsItemController::class, 'destroy'])->name('our-achievements.item.destroy');
    // countries
    Route::resource('countries', CountryController::class);

    Route::get('admin/logout', [AdminUserController::class, 'logout'])
        ->name('admin.logout');
});



Route::get('admin/register', function () {
    return view('dashboard.registration');
})->name('admin.register');

Route::get('admin/verifyotp', function () {
    return view('dashboard.verify-otp');
})->name('admin.verifyotp');

Route::post('admin/register', [AdminUserController::class, 'store'])->name('admin.register.store');
Route::get('admin/verify-otp', [AdminUserController::class, 'showOtpForm'])->name('admin.verify-otp');
Route::post('admin/verify-otp', [AdminUserController::class, 'verifyOtp'])->name('admin.verify-otp.verify');

Route::get('admin/login', function () {
    return view('dashboard.login');
})->name('admin.login');


Route::post('admin/login', [AdminUserController::class, 'login'])->name('admin.login.submit');
