<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\addToCartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;

// route ke home
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('all.about.home');

// route fitur register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// route untuk login 
Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate']);

// route  untuk logout
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

// route untuk profilem
Route::get('/profile', [ProfileController::class, 'index'])->middleware(('auth'));

Route::post('/cart{Daftar_menu}', [addToCartController::class, 'addToCart'])->name('add.to.cart');