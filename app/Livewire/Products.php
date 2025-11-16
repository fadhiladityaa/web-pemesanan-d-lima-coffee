<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use Livewire\Component;

class Products extends Component
{

    public function addToCart ($id)
    {
        
    }

    public function render()
    {
        return view('livewire.products', [
            'menus' => Daftar_menu::all()
        ]);
    }
}
