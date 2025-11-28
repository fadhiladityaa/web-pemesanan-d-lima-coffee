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
    public function mount(Daftar_menu $daftar_menus)
    {
        // Route model binding otomatis ambil data berdasarkan ID dari URL
        $this->menu = $daftar_menus->load('bahanbaku', 'kandungan');
    }

    public function render()
    {
        return view('livewire.detail-menu', [
            'menu' => $this->menu
        ]);
    }
}
