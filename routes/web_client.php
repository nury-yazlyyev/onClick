<?php

use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\ClientController\FollowController;
use App\Http\Controllers\ClientController\HomeController;
use App\Http\Controllers\ClientController\LoginController;
use App\Http\Controllers\ClientController\SigninController;
use App\Http\Controllers\ClientController\VendorController;
use App\Http\Middleware\IsClient;
use App\Http\Middleware\IsVendor;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/show/{id}',[HomeController::class,'show'])->name('show');
Route::get('/show/{id}/store',[VendorController::class,'vendor_profile'])->name('vendor.profile');
Route::get('/shops',[HomeController::class,'shops'])->name('shops');
Route::get('/seller',[VendorController::class,'create'])->name('seller');
Route::post('/seller',[VendorController::class,'store']);

Route::get('locale/{locale}', [HomeController::class, 'locale'])->name('locale')->where('locale', '[a-z]+');

Route::middleware('guest')
->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    Route::get('signin', [SigninController::class, 'create'])->name('signin');
    Route::post('signin', [SigninController::class, 'store']);
});

Route::middleware('auth')
    ->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    });
Route::middleware('auth',IsClient::class)
    ->group(function () {
        Route::post('/follow/{vendorId}', [FollowController::class, 'following'])->name('follow');
    });
Route::middleware(['auth',IsVendor::class])
    ->group(function () {
        Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
        Route::resource('/vendor/products', AdminController::class);
        // Route::post('/vendor/store', [VendorController::class, 'vendor_store'])->name('vendor.store');
    });
