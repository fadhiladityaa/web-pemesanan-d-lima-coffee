<?php

namespace App\Livewire;

use App\Models\Daftar_menu;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class MenuManagement extends Component
{

    public function delete($id)
    {
        Daftar_menu::find($id)->delete();
        session()->flash('message', 'Menu berhasil dihapus.');
    }
    
    #[Title('Menu Management')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.dashboard.menu-management', [
            'menu' => Daftar_menu::all(),
        ]);
    }
}
