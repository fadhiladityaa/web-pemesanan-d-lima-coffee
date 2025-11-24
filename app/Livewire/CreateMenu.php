<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Daftar_menu;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

// use Illuminate\Auth\Events\Validated;

class CreateMenu extends Component
{

    #[Validate('required|string|min:3|unique:daftar_menus,nama_menu')]
    public $nama_menu = '';
    
    
    #[Validate('required|numeric|min:0')]
    public $harga = 0;
    
    
    #[Validate('nullable|image|mimes:jpg,jpeg,png|max:2048')]
    public $gambar;
    
    
    #[Validate('nullable|string|max:500')]
    public $deskripsi = '';

    // wajib pakai ini kalau ada upload file
    use WithFileUploads;

    public function createNewMenu()
    {
        $validated = $this->validate();

        if ($this->gambar) {
            $validated['gambar'] = $this->gambar->store('gambar', 'public');
        };
    
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
