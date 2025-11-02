<?php

use App\Http\Controllers\AdminController\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/admin',[AdminController::class,'index'])->name('index');
Route::get('/admin/create',[AdminController::class,'create'])->name('create.product');
Route::post('/admin/store',[AdminController::class,'store'])->name('store.product');


