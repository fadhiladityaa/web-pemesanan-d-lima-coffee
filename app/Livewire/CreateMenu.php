<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Daftar_menu;
use App\Models\KandunganMenu;
use App\Models\BahanBakuMenu;
use App\Models\SmallWarning;

class CreateMenu extends Component
{
    use WithFileUploads;

    // --- Menu Utama ---
    #[Validate('required|string|min:3|unique:daftar_menus,nama_menu')]
    public $nama_menu = '';

    #[Validate('required|numeric|min:0')]
    public $harga = 0;

    #[Validate('nullable|image|mimes:jpg,jpeg,png|max:2048')]
    public $gambar;

    #[Validate('nullable|string|max:500')]
    public $deskripsi = '';

    // --- Kandungan Gizi ---
    #[Validate('required|numeric|min:0')]
    public $energi_total;

    #[Validate('required|numeric|min:0')]
    public $takaran_saji;  

    #[Validate('nullable|numeric|min:0')]
    public $protein;

    #[Validate('nullable|numeric|min:0')]
    public $lemak_total;

    #[Validate('nullable|numeric|min:0')]
    public $lemak_jenuh;

    #[Validate('nullable|numeric|min:0')]
    public $karbohidrat;

    #[Validate('nullable|numeric|min:0')]
    public $gula;

    #[Validate('nullable|numeric|min:0')]
    public $garam_natrium;

    #[Validate('nullable|numeric|min:0')]
    public $kafein;

    #[Validate('nullable|string|max:500')]
    public $batas_konsumsi;

    public $pesan = '';

    // --- Bahan Baku (array dinamis) ---
    public $bahanBaku = [
        ['nama_bahan' => '', 'takaran' => '']
    ];

    protected function rules()
    {
        return [
            'bahanBaku.*.nama_bahan' => 'required|string|min:3',
            'bahanBaku.*.takaran'    => 'nullable|string|max:50',
        ];
    }

    public function addBahanBaku()
    {
        $this->bahanBaku[] = ['nama_bahan' => '', 'takaran' => ''];
    }

    public function removeBahanBaku($index)
    {
        unset($this->bahanBaku[$index]);
        $this->bahanBaku = array_values($this->bahanBaku);
    }

    public function createNewMenu()
    {
        // Validasi semua field (menu utama, kandungan, bahan baku)
        $this->validate();

        // Simpan menu utama
        $menu = Daftar_menu::create([
            'nama_menu' => $this->nama_menu,
            'harga' => $this->harga,
            'gambar' => $this->gambar ? $this->gambar->store('gambar', 'public') : null,
            'deskripsi' => $this->deskripsi,
            'pesan' => $this->pesan,
        ]);

        // Simpan kandungan total (termasuk takaran_saji)
        KandunganMenu::create([
            'daftar_menu_id' => $menu->id,
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
        ]);

        // Simpan bahan baku
        foreach ($this->bahanBaku as $bahan) {
            BahanBakuMenu::create([
                'daftar_menu_id' => $menu->id,
                'nama_bahan' => $bahan['nama_bahan'],
                'takaran' => $bahan['takaran'],
            ]);
        }

        $this->reset();
        return redirect()->route('dashboard.menu.management')
            ->with('success', 'Menu berhasil ditambahkan!');
    }

    #[Title('Create Menu')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.dashboard.create-menu');
    }
}
