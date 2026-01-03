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
    public function toggleFeatured($id)
    {
        $menu = \App\Models\Daftar_menu::find($id); // Pastikan Model benar
        if ($menu) {
            $menu->is_featured = !$menu->is_featured;
            $menu->save();
            session()->flash('message', 'Status rekomendasi diubah!');
        }
    }
    public function render()
    {
        return view('livewire.dashboard.menu-management', [
            'menu' => Daftar_menu::all(),
        ]);
    }
}
