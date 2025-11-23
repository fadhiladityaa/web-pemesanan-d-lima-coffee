<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Daftar_menu;
// use Illuminate\Auth\Events\Validated;

class CreateMenu extends Component
{

    public $nama_menu = '';
    public $harga = '';
    public $gambar = '';
    public $deskripsi = '';

    public function createNewMenu()
    {

        $validated = $this->validate([
            'nama_menu' => 'required|string|min:3|unique:daftar_menus,nama_menu',
            'harga'     => 'required|numeric|min:0',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        Daftar_menu::create($validated);

        $this->reset();
    }

    #[Title('create menu')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.dashboard.create-menu');
    }
}
