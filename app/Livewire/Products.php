<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
use App\Models\MenuCategory;
use App\Models\Promo; 
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    // Variabel yang sudah ada
    public $search = '';

    // Variabel untuk filter
    public $promo_id = null; 
    public $kategoriFilter = ''; 

    // Agar parameter ?promo_id=... di URL bisa dibaca
    protected $queryString = ['search', 'promo_id', 'kategoriFilter'];

    // Menangkap ID promo saat halaman dimuat
    public function mount()
    {
        if(request()->has('promo_id')){
            $this->promo_id = request()->query('promo_id');
        }
    }

    // --- FITUR ADD TO CART (SUDAH DIPERBAIKI LOGIKANYA) ---
    public function addToCart($menu_id)
    {
        $user_id = Auth::id();
        
        // Cek login
        if(!$user_id) {
            return redirect()->route('login');
        }

        $cart = CartModel::firstOrCreate(
            ['user_id' => $user_id, 'status' => 'pending'],
            ['created_at' => now()],
        );

        $item = CartItem::where('cart_id', $cart->id)
            ->where('daftar_menu_id', $menu_id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $menu = Daftar_menu::findOrfail($menu_id);

            // ==========================================
            // [LOGIKA BARU] Hitung Harga Diskon Dulu
            // ==========================================
            $finalPrice = $menu->harga; // Default harga normal

            // Cek apakah user sedang membuka halaman lewat link promo?
            if ($this->promo_id) {
                $promo = Promo::find($this->promo_id);

                // Validasi: Pastikan promo ada & Menu ini BENAR-BENAR terdaftar di promo tersebut
                if ($promo && $menu->promos()->where('promos.id', $this->promo_id)->exists()) {
                    // Rumus hitung diskon
                    $diskon = $menu->harga * ($promo->persentase_diskon / 100);
                    $finalPrice = $menu->harga - $diskon;
                }
            }
            // ==========================================

            CartItem::create([
                'cart_id' => $cart->id,
                'daftar_menu_id' => $menu->id,
                'quantity' => 1,
                'price' => $finalPrice, // <--- PENTING: Pakai harga yang sudah dihitung
            ]);
        };
        $this->dispatch('cart_updated');
    }

    public function render()
    {
        $query = Daftar_menu::query();

        // 1. Filter Pencarian
        if ($this->search) {
            $query->where('nama_menu', 'like', '%' . $this->search . '%');
        }

        // 2. Filter Kategori
        if ($this->kategoriFilter) {
            $query->where('kategori', $this->kategoriFilter);
        }

        // 3. Filter Promo
        $activePromo = null;
        if ($this->promo_id) {
            // Filter menu yang punya relasi dengan promo ini
            $query->whereHas('promos', function($q) {
                $q->where('promos.id', $this->promo_id);
            });
            
            // Ambil data promo untuk judul banner
            $activePromo = Promo::find($this->promo_id);
        }

        $coffee = MenuCategory::where('name', 'Coffee')->first();
        $non_coffee = MenuCategory::where('name', 'Non Coffee')->first();
        $moctail = MenuCategory::where('name', 'Moctail')->first();
        $makanan_ringan = MenuCategory::where('name', 'Makanan Ringan')->first();
        $makanan_berat = MenuCategory::where('name', 'Makanan Berat')->first();

        return view('livewire.products', [
            'menus' => $query->get(),
            'coffee' => $coffee->daftar_menus,
            'non_coffee' => $non_coffee->daftar_menus,
            'moctail' => $moctail->daftar_menus,
            'makanan_ringan' => $makanan_ringan->daftar_menus,
            'makanan_berat' => $makanan_berat->daftar_menus,
            'activePromo' => $activePromo 
        ]);
    }

    // Fungsi Reset Filter
    public function resetFilters()
    {
        $this->search = '';
        $this->kategoriFilter = '';
        $this->promo_id = null;
    }
}