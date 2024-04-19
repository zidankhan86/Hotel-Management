<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\HeroBannerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [IndexController::class, 'dashboard'])->name('dashboard');

Route::get('/login-frontend', [LoginController::class, 'showLoginFormFrontend'])->name('login.frontend');
//Registration
Route::get('/registration', [LoginController::class, 'registration'])->name('registration');
Route::post('/registration', [LoginController::class, 'registrationStore'])->name('registration.submit');


//Backend

//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



//Middleware for check valid user
Route::group(['middleware' => 'customerAuth'], function () {
//
});

//middleware auth and admin
Route::group(['middleware' => 'auth','admin','prefix'=>'admin'], function () {

    Route::get('/', function () {
        return view('backend.index');
    });
//profile
Route::get('/profile',[ProfileController::class,'profile']);
Route::get('/admin-profile',[ProfileController::class,'adminProfile']);

Route::get('/', [IndexController::class, 'dashboard'])->name('dashboard');
Route::resource('room', RoomController::class);
Route::resource('facilities', FacilitiesController::class);
Route::resource('features', FeaturesController::class);


Route::get('/banner', [BannerController::class, 'bannerForm'])->name('banner.form');
Route::post('/banner-store', [BannerController::class, 'bannerStore'])->name('banner.store');


});
