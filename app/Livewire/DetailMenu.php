<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Daftar_menu;

class DetailMenu extends Component
{
    public $menu;

    public function mount($id)
    {
        // Pastikan modelnya 'Daftar_menu' (sesuai model Anda)
        $this->menu = Daftar_menu::with(['kandungan', 'bahanbaku'])->findOrFail($id);
    }

    #[Title('Detail Menu')]
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.detail-menu');
    }
}