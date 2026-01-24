<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\HeroSectionController;



// ..........................................................Website Portion........................................................
// Route::get('/', function () {
//     return view('website.home');
// })->name('homepage');

Route::get('/', [HomeController::class, 'index'])->name('homepage');

















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
    // Return JSON for a hero
    Route::get('/hero/{hero}/edit-json', [HeroSectionController::class, 'editJson'])->name('hero.edit');
    Route::put('hero/{hero}', [HeroSectionController::class, 'update'])->name('hero.update');
    Route::delete('hero/{hero}', [HeroSectionController::class, 'destroy'])->name('hero.destroy');


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
