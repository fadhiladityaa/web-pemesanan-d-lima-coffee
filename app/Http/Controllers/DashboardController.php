<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Daftar_menu;
use App\Models\Edukasi;
use App\Models\Promo;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // [LOGIKA LAMA - TETAP AMAN]
        if (!$user) {
            return redirect()->route('login');
        }

        // [LOGIKA LAMA - TETAP AMAN]
        // Pengecekan Admin tetap prioritas utama
        if ($user->isAdmin()) {
            return redirect()->route('dashboard.pesanan.masuk');
        }

        // [LOGIKA LAMA - TETAP AMAN]
        $lastOrder = Order::where('user_id', $user->id)
            ->latest()
            ->first();

        // [LOGIKA LAMA - TETAP AMAN]
        // Note: Saya pastikan take(10) agar slider rekomendasi bisa digeser
        $featuredProducts = Daftar_menu::where('is_featured', 1)
            ->take(10) 
            ->get();

        // [LOGIKA LAMA - TETAP AMAN]
        $edukasi = Edukasi::latest()->first();

        // [LOGIKA LAMA - TETAP AMAN]
        // Slider Promo (Daftar promo yang berjejer)
        $promos = Promo::where('status', 'aktif')->latest()->take(5)->get();


      $popupPromos = Promo::where('status', 'aktif')
        // ->whereDate('tanggal_mulai', '<=', now())
        // ->whereDate('tanggal_berakhir', '>=', now())
        // ->latest()
        ->take(5) // Ambil 5 promo terbaru
        ->get();  // Pakai get() bukan first()

    $title = 'Dashboard Pelanggan';

    // [UPDATE COMPACT]
    // Ganti 'popupPromo' menjadi 'popupPromos'
    return view('dashboard-pelanggan', compact(
        'user', 'lastOrder', 'featuredProducts', 'edukasi', 'promos', 'title', 
        'popupPromos' // <--- Perhatikan ada huruf 's'
    ));

    }
}