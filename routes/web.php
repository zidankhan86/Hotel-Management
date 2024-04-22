<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\RoomController as FrontendRoomController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomAvailabilityController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

//profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('/', [HomeController::class, 'home'])->name('home');

//Registration
Route::post('/registration', [LoginController::class, 'registrationStore'])->name('registration.submit');

//Backend
//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login-submit', [LoginController::class, 'loginProcess'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/room-page', [FrontendRoomController::class, 'room_page'])->name('room.page');

Route::get('/contact-page', [ContactController::class, 'contact_us'])->name('contact.page');
Route::post('/contact-page-store', [ContactController::class, 'contact_store'])->name('contact.store');
Route::get('/about-page', [AboutController::class, 'about_page'])->name('about.page');

//Middleware for check valid user
Route::group(['middleware' => 'customerAuth'], function () {
    Route::get('/room-details-page/{id}', [FrontendRoomController::class, 'room_details_page'])->name('room.details.page');
    Route::post('/Check-Room-Availability', [RoomAvailabilityController::class, 'CheckRoomAvailability'])->name('room.availability');
});

//middleware auth and admin
Route::group(['middleware' => 'auth', 'admin', 'prefix' => 'admin'], function () {

    Route::get('/', [IndexController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin-profile', [ProfileController::class, 'adminProfile']);
    Route::resource('room', RoomController::class);
    Route::resource('facilities', FacilitiesController::class);
    Route::get('/facilities-delete/{id}', [FacilitiesController::class, 'facilities_delete'])->name('facilities.delete');
    Route::resource('features', FeaturesController::class);
    Route::get('/features-delete/{id}', [FeaturesController::class, 'features_delete'])->name('features.delete');
    Route::resource('setting', SettingController::class);
    Route::post('/banner-store', [BannerController::class, 'bannerStore'])->name('banner.store');
    Route::get('/banner-delete/{id}', [BannerController::class, 'bannerdelete'])->name('banner.delete');
    Route::post('/about-store', [AboutController::class, 'about_store'])->name('about.store');
    Route::get('/about-delete/{id}', [AboutController::class, 'about_delete'])->name('about.delete');
    Route::get('/booking-list', [OrderController::class, 'booking_list'])->name('booking.list');
    Route::put('/Booking-Status/{id}', [OrderController::class, 'StatusUpdate'])->name('booking.status');

});
