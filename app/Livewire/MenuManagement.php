<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk hapus gambar

class MenuManagement extends Component
{
    #[Title('Menu Management')]
    #[Layout('layouts.admin')]

    public function delete($id)
    {
        $menu = Daftar_menu::find($id);

        if ($menu) {
            try {
                // 1. Hapus Gambar Fisik
                if ($menu->gambar) {
                    Storage::disk('public')->delete($menu->gambar);
                }

                // 2. Putuskan relasi Promo
                if (method_exists($menu, 'promos')) {
                    $menu->promos()->detach();
                }

                // 3. Hapus Kandungan
                if ($menu->kandungan) {
                    $menu->kandungan()->delete();
                }

                // 4. Hapus Bahan Baku
                if ($menu->bahanBaku) {
                    $menu->bahanBaku()->each(function($bahan) {
                        $bahan->delete();
                    });
                }

                // 5. COBA HAPUS MENU UTAMA
                $menu->delete();

                session()->flash('message', 'Menu berhasil dihapus.');

            } catch (\Illuminate\Database\QueryException $e) {
                // TANGKAP ERROR 23000 (Integrity Constraint / Foreign Key)
                if ($e->getCode() == "23000") {
                    session()->flash('error', 'GAGAL: Menu ini tidak bisa dihapus karena sudah ada riwayat transaksi (Pesanan/Keranjang).');
                } else {
                    session()->flash('error', 'Terjadi kesalahan database: ' . $e->getMessage());
                }
            }
        }
    }

    public function toggleFeatured($id)
    {
        $menu = Daftar_menu::find($id);
        
        if ($menu) {
            $menu->is_featured = !$menu->is_featured;
            $menu->save();
            session()->flash('message', 'Status rekomendasi diubah!');
        }
    }

    public function render()
    {
        // Menggunakan latest() agar data terbaru muncul di atas
        return view('livewire.dashboard.menu-management', [
            'menu' => Daftar_menu::latest()->get(), 
        ]);
    }
}