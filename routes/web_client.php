<?php

use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\ClientController\CartController;
use App\Http\Controllers\ClientController\CommentController;
use App\Http\Controllers\ClientController\FollowController;
use App\Http\Controllers\ClientController\HomeController;
use App\Http\Controllers\ClientController\LikeController;
use App\Http\Controllers\ClientController\LoginController;
use App\Http\Controllers\ClientController\SigninController;
use App\Http\Controllers\ClientController\VendorController;
use App\Http\Middleware\IsClient;
use App\Http\Middleware\IsVendor;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/show/{id}', [HomeController::class, 'show'])->name('show');
Route::get('/show/{id}/shop', [VendorController::class, 'vendor_profile'])->name('vendor.profile');
Route::get('/shops', [HomeController::class, 'shops'])->name('shops');

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
Route::middleware('auth', IsClient::class)
    ->group(function () {
        Route::get('/seller', [VendorController::class, 'create'])->name('seller');
        Route::post('/seller', [VendorController::class, 'store']);
        Route::post('/follow/{vendorId}', [FollowController::class, 'following'])->name('follow');
        Route::post('like/{product_id}', [LikeController::class, 'like'])->name('like');
        Route::get('liked', [LikeController::class, 'liked'])->name('liked');
    });
    Route::controller(CommentController::class)->middleware('auth', IsClient::class)
    ->prefix('comment')
    ->group(function () {
        Route::post('{id}', [CommentController::class, 'store'])->name('comment.store');
        Route::post('destroy/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
    });
Route::middleware(['auth', IsVendor::class])
    ->group(function () {
        Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
        Route::resource('vendor/products', ProductController::class);
    });
Route::controller(CartController::class)->group(function(){
    Route::get('cart', 'index')->name('cart.index');
    Route::post('cart/add', 'addToCart')->name('cart.add');
});