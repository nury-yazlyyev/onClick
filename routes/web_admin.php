<?php

use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\AdminController\LoginController;
use App\Http\Controllers\AdminController\ProductController;
use App\Http\Controllers\AdminController\VendorController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->middleware('throttle:60,1')
    ->group(function () {
        Route::get('admin/login', [LoginController::class, 'create'])->name('admin.login');
        Route::post('admin/login', [LoginController::class, 'store']);
    });

Route::controller(AdminController::class)->middleware('auth:admin')
    ->prefix('admin')
    ->group(function () {
        Route::get('', 'index')->name('admin.index');
    });

Route::controller(ProductController::class)->middleware('auth:admin')
    ->prefix('admin')
    ->group(function () {
        Route::get('create', 'create')->name('admin.create.product');
        Route::post('create', 'store');
    });

Route::controller(VendorController::class)->middleware('auth:admin')
    ->prefix('admin')
    ->group(function () {
        Route::get('/seller', 'create')->name('admin.seller');
        Route::post('/seller', 'store');
    });
