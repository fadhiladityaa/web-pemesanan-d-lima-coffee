<?php

// livewire class
use App\Livewire\DetailPesanan;
use App\Livewire\PesananSaya;

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
use App\Livewire\CreateMenu;
use App\Livewire\DashboardAdmin;
use App\Livewire\EditMenu;
use App\Livewire\MenuManagement;
use App\Livewire\PesananMasuk;

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

// Route::get('/menu', [menuController::class, 'index'])->name('menu.utama');

// Route ke halaman dashboard
// Route::get('/dashboard', function() {
//     return view('dashboard.index', [
//         'title' => 'dasbor',
//     ]);
// });

// Route untuk crud menu
// Route::get('/dashboard/menu-management', [menuController::class, 'index'])->name('menu.index');
// Route::get('/dashboard/{daftar_menu:nama_menu}/edit', [menuController::class, 'edit'])->name('menu.edit');
// Route::put('/dashboard/{daftar_menu}', [menuController::class, 'update'])->name('menu.update');
// Route::post('/tambah-menu', [menuController::class, 'store'])->name('menu.store');
// Route::delete('/menu/{daftar_menu}', [menuController::class, 'destroy'])->name('menu.destroy');
// Route::get('/dashboard/menu/create', [menuController::class, 'create'])->name('menu.create');

// Route untuk crud berita (kali)
// Route::get('/detail-pesanan/{order}', [DetailPesanan::class])->name('detail.pesanan');
// Route::get('/pesanan-masuk/detail-pesanan/{order}', function() { return view('detail-pesanan-view'); })->name('detail.pesanan');
Route::get('/pesanan-masuk/detail-pesanan/{order}', \App\Livewire\DetailPesanan::class)
    ->name('detail.pesanan');


// route untuk fitur add to cart
// Route::post('/add-to-cart', [CartController::class, 'store'])->name('cart.store');


// Route::get('/detail-menu', [menuController::class, 'show']);

Route::get('/checkout', function() {
    return view('checkout-view', ['title' => 'Halaman Checkout']);
})->name('checkout');


Route::get('/checkout-succees', function() {
    return view('checkout-succeed', ['title' => 'checkout-success']);
})->name('checkout.success');



// Route::get('/pesanan-masuk', function() {
//     return view('dashboard.pesanan-masuk-view',['title' => 'Pesanan Masuk']);
// })->name('pesanan.masuk');


Route::get('/pesanan-saya', PesananSaya::class)->middleware('auth')->name('user.pesanan');


Route::get('/dashboard/create-menu', CreateMenu::class);
Route::get('/dashboard-admin', DashboardAdmin::class);
Route::get('/detail-menu', function(){
    return view('detail-menu', ['title' => 'Detail Menu']);
});

Route::get('/dashboard/menu-management', MenuManagement::class);
Route::get('/dashboard/edit-menu', EditMenu::class);
Route::get('/dashboard/pesanan-masuk', PesananMasuk::class);