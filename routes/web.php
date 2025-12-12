<?php

// livewire class
use App\Livewire\DetailPesanan;
use App\Livewire\PesananSaya;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\loginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Livewire\CreateMenu;
use App\Livewire\DashboardAdmin;
use App\Livewire\DetailMenu;
use App\Livewire\EditMenu;
use App\Livewire\MenuManagement;
use App\Livewire\PromoManagement;
use App\Livewire\PesananMasuk;
use App\Livewire\Edukasi;

// route ke home
Route::get('/', [DashboardController::class, 'index']);


Route::get('/menu', [HomeController::class, 'index'])->middleware('auth')->name('menu');



// route fitur register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('all.about.home');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// route untuk login 
Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate']);

// route  untuk logout
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

// route untuk profile
Route::get('/profil-pengguna', [ProfileController::class, 'index'])->middleware(('auth'));

Route::get('/pesanan-masuk/detail-pesanan/{order}', DetailPesanan::class)
    ->name('detail.pesanan');

Route::get('/checkout', function () {
    return view('checkout-view', ['title' => 'Halaman Checkout']);
})->name('checkout');


Route::get('/checkout-succees', function () {
    return view('checkout-succeed', ['title' => 'checkout-success']);
})->name('checkout.success');

Route::get('/profil-pengguna', function () {
    return view('profil-pengguna', ['title' => 'profil-pengguna']);
})->name('profil-pengguna');

Route::get('/Login', function () {
    return view('Login', ['title' => 'Login']);
})->name('Login');


Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/create-menu', CreateMenu::class)->name('dashboard.create.menu');
    Route::get('/admin', DashboardAdmin::class)->name('dashboard.admin');
    Route::get('/menu-management', MenuManagement::class)->name('dashboard.menu.management');
    Route::get('/{id}/edit', EditMenu::class)->name('dashboard.edit.menu');
    Route::get('/pesanan-masuk', PesananMasuk::class)->name('dashboard.pesanan.masuk');
    Route::get('/edukasi-management', Edukasi::class)->name('dashboard.edukasi.management');
    Route::get('/promo-management', PromoManagement::class)->name('dashboard.promo.management');
});


Route::get('/menu/detail-menu/{daftar_menus}', DetailMenu::class)->name('detail.menu');
Route::get('/pesanan-saya', PesananSaya::class)->name('pesanan.saya');


// ... route lainnya tetap

//  EDUKASI UNTUK PELANGGAN - gunakan component yang sudah ada
Route::get('/edukasi', \App\Livewire\EdukasiPelanggan::class)->name('edukasi');

//  EDUKASI MANAGEMENT UNTUK ADMIN (tidak berubah)

//  Route untuk tombol "Lihat Halaman Pelanggan" di admin
Route::get('/edukasi-pelanggan', function () {
    return redirect()->route('edukasi');
})->name('edukasi.pelanggan');
// 