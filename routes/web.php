<?php

// livewire class
use App\Livewire\DetailPesanan;
use App\Livewire\PesananSaya;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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
use App\Livewire\Products;
use GuzzleHttp\Middleware;

// route ke home
Route::get('/', [LandingController::class, 'index']);

// route fitur register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
// Route::get('/menu', [LandingController::class, 'allMenu'])->name('landing.menu');

Route::get('/menu', [HomeController::class, 'index'])->name('menu')->middleware('auth');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// route untuk dashboard user
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// route untuk login 
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

// Forgot Password Routes
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    
    Route::get('/verify-otp', [App\Http\Controllers\ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify');
    Route::post('/verify-otp', [App\Http\Controllers\ForgotPasswordController::class, 'verifyOtp'])->name('password.verify.post');
    
    Route::get('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'reset'])->name('password.update');
});

// route  untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
    Route::get('/landing-management', \App\Livewire\LandingPageManagement::class)->name('dashboard.landing.management');
});


Route::get('/menu/detail-menu/{id}', DetailMenu::class)->name('detail.menu')->Middleware('auth');
Route::get('/pesanan-saya', PesananSaya::class)->name('pesanan.saya');

//  EDUKASI UNTUK PELANGGAN - gunakan component yang sudah ada
Route::get('/edukasi', \App\Livewire\EdukasiPelanggan::class)->name('edukasi')->middleware('auth');

//  Route untuk tombol "Lihat Halaman Pelanggan" di admin
Route::get('/edukasi-pelanggan', function () {
    return redirect()->route('edukasi');
})->name('edukasi.pelanggan');
// 