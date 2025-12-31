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


use App\Http\Controllers\LandingController;

// route ke home
Route::get('/', [LandingController::class, 'index']);


// Route::get('/menu', [HomeController::class, 'index'])->middleware('auth')->name('menu');



// route fitur register
// route fitur register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::get('/menu', [LandingController::class, 'allMenu'])->name('landing.menu');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// route untuk dashboard user
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// route untuk login 
Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'authenticate'])->middleware('guest');

// route  untuk logout
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

// route untuk profile
Route::get('/profil-pengguna', [ProfileController::class, 'index'])->middleware('auth')->name('profile-pengguna');
Route::put('/profil-pengguna', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::put('/profil-pengguna/password', [ProfileController::class, 'updatePassword'])->middleware('auth')->name('profile.password');

Route::get('/pesanan-masuk/detail-pesanan/{order}', DetailPesanan::class)
    ->name('detail.pesanan')->middleware('auth');

Route::get('/checkout', function () {
    return view('checkout-view', ['title' => 'Halaman Checkout']);
})->name('checkout')->middleware('auth');

Route::get('/buy-now/{id}', [\App\Http\Controllers\CartController::class, 'buyNow'])->name('cart.buyNow')->middleware('auth');
Route::get('/order/{id}/receipt', [\App\Http\Controllers\OrderController::class, 'printReceipt'])->name('order.receipt')->middleware('auth');
Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransController::class, 'callback']);


Route::get('/checkout-succees', function () {
    return view('checkout-succeed', ['title' => 'checkout-success']);
})->name('checkout.success')->middleware('auth');


Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/profile', \App\Livewire\AdminProfile::class)->name('dashboard.profile');
    Route::get('/create-menu', CreateMenu::class)->name('dashboard.create.menu');
    Route::get('/admin', DashboardAdmin::class)->name('dashboard.admin');
    Route::get('/menu-management', MenuManagement::class)->name('dashboard.menu.management');
    Route::get('/user-management', \App\Livewire\UserManagement::class)->name('dashboard.user.management');
    Route::get('/{id}/edit', EditMenu::class)->name('dashboard.edit.menu');
    Route::get('/pesanan-masuk', PesananMasuk::class)->name('dashboard.pesanan.masuk');
    Route::get('/edukasi-management', Edukasi::class)->name('dashboard.edukasi.management');
    Route::get('/promo-management', PromoManagement::class)->name('dashboard.promo.management');
});


Route::get('/menu/detail-menu/{daftar_menus}', DetailMenu::class)->name('detail.menu');
Route::get('/pesanan-saya', PesananSaya::class)->name('pesanan.saya');



//  EDUKASI UNTUK PELANGGAN - gunakan component yang sudah ada
Route::get('/edukasi', \App\Livewire\EdukasiPelanggan::class)->name('edukasi')->middleware('auth');


//  Route untuk tombol "Lihat Halaman Pelanggan" di admin
Route::get('/edukasi-pelanggan', function () {
    return redirect()->route('edukasi');
})->name('edukasi.pelanggan');
// 