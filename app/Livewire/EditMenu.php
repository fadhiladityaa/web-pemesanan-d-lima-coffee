<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\Daftar_menu;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
class EditMenu extends Component
{
    public $menuId;
    public $nama_menu;
    public $harga;
    public $deskripsi;

    public $oldImage; // path lama dari DB
    public $gambar;   // file baru (upload)

    use WithFileUploads;

    public function mount($id)
    {
        $this->menuId = $id;
        $menu = Daftar_menu::findOrFail($id);

        $this->nama_menu = $menu->nama_menu;
        $this->harga = $menu->harga;
        $this->deskripsi = $menu->deskripsi;
        $this->oldImage = $menu->gambar; // simpan path lama
    }

    public function edit()
    {
        $validated = $this->validate([
            'nama_menu' => 'required|string|min:3|unique:daftar_menus,nama_menu,' . $this->menuId,
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = Daftar_menu::findOrFail($this->menuId);

        // kalau ada file baru
        if ($this->gambar instanceof TemporaryUploadedFile) {
            if ($menu->gambar) {
                Storage::delete('public/' . $menu->gambar);
            }
            $validated['gambar'] = $this->gambar->store('menu', 'public');
        } else {
            $validated['gambar'] = $this->oldImage; // pakai gambar lama
        }

        $menu->update($validated);

        session()->flash('success', 'Menu berhasil diupdate.');
        return redirect('/dashboard/menu-management');
    }

    #[Title('Edit Menu')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.dashboard.edit-menu');
    }
}
