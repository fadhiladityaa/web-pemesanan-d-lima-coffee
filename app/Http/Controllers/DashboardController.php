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

        // --- 1. CEK USER LOGIN (Agar tidak error jika Guest masuk) ---
        if (!$user) {
            return redirect()->route('login');
        }

        // --- 2. LOGIKA REDIRECT (POLISI LALU LINTAS) ---
        // Jika yang masuk ternyata ADMIN, langsung oper ke Dashboard Admin
        if ($user->isAdmin()) {
            return redirect()->route('dashboard.pesanan.masuk');
        }
        // -----------------------------------------------------------

        // --- KODE ASLI DASHBOARD PELANGGAN KAMU (TIDAK BERUBAH) ---
        
        // Ambil pesanan terakhir
        $lastOrder = Order::where('user_id', $user->id)
            ->latest()
            ->first();

        // Produk unggulan: 3 item
        $featuredProducts = Daftar_menu::where('is_featured', 1)
            ->take(3)
            ->get();

        // Cuplikan edukasi: 1 artikel terbaru
        $edukasi = Edukasi::latest()->first();

        // 3 promo terbaru
        $promos = Promo::latest()->take(3)->get();
        $title = 'Dashboard Pelanggan';
        return view('dashboard-pelanggan', compact(
            'user',
            'lastOrder',
            'featuredProducts',
            'edukasi',
            'promos',
            'title'
        ));
    }
}