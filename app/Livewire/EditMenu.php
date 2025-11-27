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

    public $oldImage;
    public $gambar;

    // --- Kandungan Gizi ---
    public $energi_total;
    public $takaran_saji;
    public $protein;
    public $lemak_total;
    public $lemak_jenuh;
    public $karbohidrat;
    public $gula;
    public $garam_natrium;
    public $kafein;
    public $batas_konsumsi;

    // --- Bahan Baku ---
    public $bahanBaku = [];

    use WithFileUploads;

    public function mount($id)
    {
        $this->menuId = $id;
        $menu = Daftar_menu::with(['kandungan','bahanBaku'])->findOrFail($id);

        // isi menu utama
        $this->nama_menu = $menu->nama_menu;
        $this->harga = $menu->harga;
        $this->deskripsi = $menu->deskripsi;
        $this->oldImage = $menu->gambar;

        // isi kandungan
        if ($menu->kandungan) {
            $this->energi_total = $menu->kandungan->energi_total;
            $this->takaran_saji = $menu->kandungan->takaran_saji;
            $this->protein      = $menu->kandungan->protein;
            $this->lemak_total  = $menu->kandungan->lemak_total;
            $this->lemak_jenuh  = $menu->kandungan->lemak_jenuh;
            $this->karbohidrat  = $menu->kandungan->karbohidrat;
            $this->gula         = $menu->kandungan->gula;
            $this->garam_natrium= $menu->kandungan->garam_natrium;
            $this->kafein       = $menu->kandungan->kafein;
            $this->batas_konsumsi = $menu->kandungan->batas_konsumsi;
        }

        // isi bahan baku
        $this->bahanBaku = $menu->bahanBaku->map(fn($bahan) => [
            'id' => $bahan->id,
            'nama_bahan' => $bahan->nama_bahan,
            'takaran' => $bahan->takaran,
        ])->toArray();
    }

    public function edit()
    {
        $validated = $this->validate([
            'nama_menu' => 'required|string|min:3|unique:daftar_menus,nama_menu,' . $this->menuId,
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string|max:500',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'energi_total' => 'required|numeric|min:0',
            'takaran_saji' => 'required|numeric|min:0',
            'protein' => 'nullable|numeric|min:0',
            'lemak_total' => 'nullable|numeric|min:0',
            'lemak_jenuh' => 'nullable|numeric|min:0',
            'karbohidrat' => 'nullable|numeric|min:0',
            'gula' => 'nullable|numeric|min:0',
            'garam_natrium' => 'nullable|numeric|min:0',
            'kafein' => 'nullable|numeric|min:0',
            'batas_konsumsi' => 'nullable|string|max:500',

            'bahanBaku.*.nama_bahan' => 'required|string|min:3',
            'bahanBaku.*.takaran'    => 'nullable|string|max:50',
        ]);

        $menu = Daftar_menu::findOrFail($this->menuId);

        // update gambar
        if ($this->gambar instanceof TemporaryUploadedFile) {
            if ($menu->gambar) {
                Storage::delete('public/' . $menu->gambar);
            }
            $validated['gambar'] = $this->gambar->store('menu', 'public');
        } else {
            $validated['gambar'] = $this->oldImage;
        }

        // update menu utama
        $menu->update([
            'nama_menu' => $this->nama_menu,
            'harga' => $this->harga,
            'deskripsi' => $this->deskripsi,
            'gambar' => $validated['gambar'],
        ]);

        // update kandungan
        $menu->kandungan()->updateOrCreate(
            ['daftar_menu_id' => $menu->id],
            [
                'energi_total' => $this->energi_total,
                'takaran_saji' => $this->takaran_saji,
                'protein' => $this->protein,
                'lemak_total' => $this->lemak_total,
                'lemak_jenuh' => $this->lemak_jenuh,
                'karbohidrat' => $this->karbohidrat,
                'gula' => $this->gula,
                'garam_natrium' => $this->garam_natrium,
                'kafein' => $this->kafein,
                'batas_konsumsi' => $this->batas_konsumsi,
            ]
        );

        // update bahan baku (hapus lama, simpan ulang)
        $menu->bahanBaku()->delete();
        foreach ($this->bahanBaku as $bahan) {
            $menu->bahanBaku()->create([
                'nama_bahan' => $bahan['nama_bahan'],
                'takaran' => $bahan['takaran'],
            ]);
        }

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
