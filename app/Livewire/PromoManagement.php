<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Promo;
use App\Models\Daftar_menu; // Pastikan model ini benar sesuai codinganmu
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class PromoManagement extends Component
{
    use WithFileUploads;

    // Variabel Form
    public $judul, $deskripsi, $kode_promo, $persentase_diskon, $gambar, $status = 'aktif';
    public $tanggal_mulai, $tanggal_berakhir;
    
    // Variabel System
    public $promo_id;
    public $isEditMode = false;
    public $showForm = false;
    public $gambar_lama; 

    // [BARU] Variabel untuk menampung Menu yang dipilih
    public $selectedMenus = []; 

    // Validasi
    protected $rules = [
        'judul' => 'required|string|max:255',
        'kode_promo' => 'required|string|max:20|unique:promos,kode_promo',
        'persentase_diskon' => 'required|integer|min:1|max:100',
        'tanggal_mulai' => 'required|date',
        'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        'status' => 'required',
        'gambar' => 'nullable|image|max:2048', 
    ];

    #[Title('Promo Management')]
    #[Layout('layouts.admin')]
    public function render()
    {
        // Ambil data promo terbaru
        $promos = Promo::latest()->get();
        
        // [BARU] Ambil semua menu untuk ditampilkan di checkbox
        $allMenus = Daftar_menu::all(); 
        
        return view('livewire.promo-management', [
            'promos' => $promos,
            'allMenus' => $allMenus // Kirim data menu ke view
        ]); 
    }

    // Reset Form
    public function resetInputFields()
    {
        $this->judul = '';
        $this->deskripsi = '';
        $this->kode_promo = '';
        $this->persentase_diskon = '';
        $this->gambar = null;
        $this->gambar_lama = null;
        $this->tanggal_mulai = '';
        $this->tanggal_berakhir = '';
        $this->status = 'aktif';
        $this->promo_id = null;
        $this->isEditMode = false;
        
        // [BARU] Reset pilihan menu
        $this->selectedMenus = []; 
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
    }

    public function store()
    {
        $this->validate();

        $imagePath = null;
        if ($this->gambar) {
            $imagePath = $this->gambar->store('promos', 'public');
        }

        // Simpan Data Promo
        $promo = Promo::create([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'kode_promo' => $this->kode_promo,
            'persentase_diskon' => $this->persentase_diskon,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_berakhir' => $this->tanggal_berakhir,
            'status' => $this->status,
            'gambar' => $imagePath,
        ]);

        // [BARU] Simpan Relasi Menu yang dipilih ke tabel pivot
        // Pastikan Model Promo punya fungsi menus()
        $promo->menus()->sync($this->selectedMenus);

        session()->flash('message', 'Promo berhasil dibuat!');
        $this->resetInputFields();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $promo = Promo::find($id);
        $this->promo_id = $id;
        $this->judul = $promo->judul;
        $this->deskripsi = $promo->deskripsi;
        $this->kode_promo = $promo->kode_promo;
        $this->persentase_diskon = $promo->persentase_diskon;
        $this->tanggal_mulai = $promo->tanggal_mulai->format('Y-m-d');
        $this->tanggal_berakhir = $promo->tanggal_berakhir->format('Y-m-d');
        $this->status = $promo->status;
        $this->gambar_lama = $promo->gambar;

        // [BARU] Ambil menu yang sudah tercentang sebelumnya
        // pluck('id') mengambil hanya ID-nya saja untuk dimasukkan ke array
        $this->selectedMenus = $promo->menus->pluck('id')->toArray();
        
        $this->isEditMode = true;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate([
            'kode_promo' => 'required|string|max:20|unique:promos,kode_promo,' . $this->promo_id,
            'gambar' => 'nullable|image|max:10240',
            'judul' => 'required',
            'persentase_diskon' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
        ]);

        $promo = Promo::find($this->promo_id);
        
        $imagePath = $promo->gambar; 
        if ($this->gambar) {
            if($promo->gambar) {
                Storage::disk('public')->delete($promo->gambar);
            }
            $imagePath = $this->gambar->store('promos', 'public');
        }

        $promo->update([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'kode_promo' => $this->kode_promo,
            'persentase_diskon' => $this->persentase_diskon,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_berakhir' => $this->tanggal_berakhir,
            'status' => $this->status,
            'gambar' => $imagePath,
        ]);

        // [BARU] Update Relasi Menu
        $promo->menus()->sync($this->selectedMenus);

        session()->flash('message', 'Promo berhasil diperbarui!');
        $this->resetInputFields();
        $this->showForm = false;
    }

    public function delete($id)
    {
        $promo = Promo::find($id);
        if($promo->gambar) {
            Storage::disk('public')->delete($promo->gambar);
        }
        
        // [BARU] Hapus relasi menu (opsional, tapi biasanya otomatis jika pakai cascade di migrasi)
        $promo->menus()->detach();
        
        $promo->delete();
        session()->flash('message', 'Promo berhasil dihapus.');
    }

    public function cancel()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }
}