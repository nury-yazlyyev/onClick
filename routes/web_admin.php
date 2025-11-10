<?php

use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\AdminController\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->middleware('throttle:60,1')
    ->group(function() {
        Route::get('admin/login', [LoginController::class, 'create'])->name('admin.login');
        Route::post('admin/login', [LoginController::class, 'store']);
    });

Route::middleware('auth:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create.product');
        Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store.product');
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    });
