<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class MenuManagement extends Component
{


    #[Title('Menu Management')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.dashboard.menu-management', [
            'menu' => Daftar_menu::all(),
        ]);
    }
}
