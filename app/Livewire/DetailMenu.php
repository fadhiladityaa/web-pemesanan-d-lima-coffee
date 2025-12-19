<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Daftar_menu;

class DetailMenu extends Component
{
    public Daftar_menu $menu;

    #[Title('Detail Menu')]
    #[Layout('layouts.app')]
    public function mount($id)
    {
        // 1. Cari menu berdasarkan ID
        // 2. 'with' kita pakai supaya data 'kandungan' & 'bahanbaku' langsung terambil (biar tidak error di view)
        // 3. 'findOrFail' artinya: Cari sampai dapat, kalau tidak ada tampilkan Error 404 (Halaman Tidak Ditemukan)
        $this->menu = Daftar_menu::with(['kandungan', 'bahanbaku'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.detail-menu', [
            'menu' => $this->menu
        ]);
    }
}
