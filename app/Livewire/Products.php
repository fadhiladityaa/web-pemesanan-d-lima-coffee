<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use App\Models\Cart as CartModel;
use App\Models\CartItem;
use App\Models\MenuCategory;
use App\Models\Promo;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
// use Illuminate\Database\Eloquent\Builder;

class Products extends Component
{
    public $search = '';

    public $promo_id = null;
    public $kategoriFilter = '';

    // Agar parameter ?promo_id=... di URL bisa dibaca
    protected $queryString = ['search', 'promo_id', 'kategoriFilter'];

    // Menangkap ID promo saat halaman dimuat
    public function mount()
    {
        if (request()->has('promo_id')) {
            $this->promo_id = request()->query('promo_id');
        }
    }

    // --- FITUR ADD TO CART (SUDAH DIPERBAIKI LOGIKANYA) ---
    public function addToCart($menu_id)
    {
        $user_id = Auth::id();

        // Cek login
        if (!$user_id) {
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


    #[Layout('layouts.main')]
    #[Title('Daftar Menu')]
    public function render()
    {
        $categoryNames = ['Coffee', 'Non Coffee', 'Moctail', 'Makanan Ringan', 'Makanan Berat'];

        // 1. AMBIL DATA PROMO AKTIF
        $activePromo = $this->promo_id ? Promo::find($this->promo_id) : null;

        // 2. EAGER LOADING dengan relasi category
        $categories = MenuCategory::whereIn('name', $categoryNames)
            ->with(['daftar_menus' => function ($query) {
                $query->with('category'); // Tambahkan eager loading untuk kategori
            }, 'daftar_menus.promos'])
            ->get()
            ->keyBy('name');

        // 3. MENGAPLIKASIKAN FILTER PADA KOLEKSI
        $filteredCategories = [];
        $allMenus = collect(); // Koleksi untuk semua menu hasil pencarian
        $search = $this->search;
        $promo_id = $this->promo_id;

        foreach ($categoryNames as $name) {
            $menus = $categories[$name]->daftar_menus ?? collect();

            $menus = $menus->filter(function ($menu) use ($search, $promo_id) {
                // FILTER PENCARIAN
                if ($search && !str_contains(strtolower($menu->nama_menu), strtolower($search))) {
                    return false;
                }

                // FILTER PROMO
                if ($promo_id && !$menu->promos->contains('id', $promo_id)) {
                    return false;
                }

                return true;
            });

            // Tambahkan ke koleksi semua menu untuk pencarian
            if ($search) {
                $allMenus = $allMenus->merge($menus);
            }

            $filteredCategories[strtolower(str_replace(' ', '_', $name))] = $menus;
        }

        // 4. RETURN VIEW
        return view('livewire.products', [
            'menus' => $allMenus, 
            'coffee' => $filteredCategories['coffee'],
            'non_coffee' => $filteredCategories['non_coffee'],
            'moctail' => $filteredCategories['moctail'],
            'makanan_ringan' => $filteredCategories['makanan_ringan'],
            'makanan_berat' => $filteredCategories['makanan_berat'],
            'activePromo' => $activePromo,
            'search' => $this->search, // Kirim juga variabel search ke view
            'category' => MenuCategory::all(),
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