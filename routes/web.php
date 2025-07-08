<?php

use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\menuController;
use App\Models\Daftar_menu;
// use Faker\Guesser\Name;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\beritaController;

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

// route untuk profile
Route::get('/profile', [ProfileController::class, 'index'])->middleware(('auth'));

Route::get('/menu', [menuController::class, 'index'])->name('menu.utama');

// Route ke halaman dashboard
Route::get('/dashboard', function() {
    return view('dashboard.index', [
        'title' => 'dasbor',
    ]);
});

// Route untuk crud menu
Route::get('/dashboard/menu-management', [menuController::class, 'index'])->name('menu.index');
Route::get('/dashboard/{daftar_menu:nama_menu}/edit', [menuController::class, 'edit'])->name('menu.edit');
Route::put('/dashboard/{daftar_menu}', [menuController::class, 'update'])->name('menu.update');
Route::post('/tambah-menu', [menuController::class, 'store'])->name('menu.store');
Route::delete('/menu/{daftar_menu}', [menuController::class, 'destroy'])->name('menu.destroy');
Route::get('/dashboard/menu/create', [menuController::class, 'create'])->name('menu.create');

// Route untuk crud berita (kaliy)
Route::get('/berita', [beritaController::class, 'index'])->name('halaman-berita');
