<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\DashboardController;


// route ke home
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('all.about.home');

// route fitur register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// route untuk login 
Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate']);

// route  untuk logout
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

// route untuk profile
Route::get('/profile', [ProfileController::class, 'index'])->middleware(('auth'));

Route::get('/menu', [menuController::class, 'index'])->name('menu.utama');

// Route ke halaman dashboard

Route::get('/dashboard', [DashboardController::class, 'index']);