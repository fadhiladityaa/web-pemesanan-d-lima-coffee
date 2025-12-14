<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
use App\Models\Promo; // [BARU] Jangan lupa import Promo
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    // Variabel yang sudah ada
    public $search = '';

    // [BARU] Variabel untuk filter
    public $promo_id = null; 
    public $kategoriFilter = ''; 

    // [BARU] Agar parameter ?promo_id=... di URL bisa dibaca
    protected $queryString = ['search', 'promo_id', 'kategoriFilter'];

    // [BARU] Menangkap ID promo saat halaman dimuat
    public function mount()
    {
        if(request()->has('promo_id')){
            $this->promo_id = request()->query('promo_id');
        }
    }

    // --- FITUR ADD TO CART (TIDAK SAYA UBAH, TETAP SAMA) ---
    public function addToCart($menu_id)
    {
        $user_id = Auth::id();
        
        // Cek login (Opsional: Jika user belum login, arahkan ke login)
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

            CartItem::create([
                'cart_id' => $cart->id,
                'daftar_menu_id' => $menu->id,
                'quantity' => 1,
                'price' => $menu->harga,
            ]);
        };
        $this->dispatch('cart_updated');
    }

    public function render()
    {
        $query = Daftar_menu::query();

        // 1. Filter Pencarian (Code Lama)
        if ($this->search) {
            $query->where('nama_menu', 'like', '%' . $this->search . '%');
        }

        // 2. [BARU] Filter Kategori (Jika ada tombol kategori di view)
        if ($this->kategoriFilter) {
            $query->where('kategori', $this->kategoriFilter);
        }

        // 3. [BARU] Filter Promo
        $activePromo = null;
        if ($this->promo_id) {
            // Filter menu yang punya relasi dengan promo ini
            $query->whereHas('promos', function($q) {
                $q->where('promos.id', $this->promo_id);
            });
            
            // Ambil data promo untuk judul banner
            $activePromo = Promo::find($this->promo_id);
        }

        return view('livewire.products', [
            'menus' => $query->get(),
            'activePromo' => $activePromo // Kirim data promo ke view
        ]);
    }

    // [BARU] Fungsi Reset Filter (Opsional, untuk tombol 'Lihat Semua Menu')
    public function resetFilters()
    {
        $this->search = '';
        $this->kategoriFilter = '';
        $this->promo_id = null;
    }
}