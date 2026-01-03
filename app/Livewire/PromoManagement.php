<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Promo;
use App\Models\Daftar_menu; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // [PENTING] Tambahkan ini untuk fungsi random string
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class PromoManagement extends Component
{
    use WithFileUploads;

    public $judul, $deskripsi, $kode_promo, $persentase_diskon, $gambar, $status = 'aktif';
    public $tanggal_mulai, $tanggal_berakhir;
    public $promo_id;
    public $isEditMode = false;
    public $showForm = false;
    public $gambar_lama; 
    public $selectedMenus = []; 
    
    // [MODIFIKASI] Hapus 'kode_promo' dari rules agar tidak error saat validasi input kosong
    protected $rules = [
        'judul' => 'required|string|max:255',
        // 'kode_promo' => 'required', // <--- DIHAPUS
        'persentase_diskon' => 'required|integer|min:1|max:100',
        'tanggal_mulai' => 'required|date',
        'tanggal_berakhir' => 'required|date|after_or_equal:tanggal_mulai',
        'status' => 'required',
        'gambar' => 'nullable|image|max:10240', // Saya naikkan limit jadi 10MB sesuai request sebelumnya
    ];

    #[Title('Promo Management')]
    #[Layout('layouts.admin')] // Pastikan ini sesuai layout admin Anda (misal layouts.app)
    public function render()
    {
        $promos = Promo::latest()->get();
        $allMenus = Daftar_menu::all(); 
        
        return view('livewire.promo-management', [
            'promos' => $promos,
            'allMenus' => $allMenus 
        ]); 
    }

    public function resetInputFields()
    {
        $this->judul = '';
        $this->deskripsi = '';
        $this->kode_promo = ''; // Tetap di-reset tidak masalah
        $this->persentase_diskon = '';
        $this->gambar = null;
        $this->gambar_lama = null;
        $this->tanggal_mulai = '';
        $this->tanggal_berakhir = '';
        $this->status = 'aktif';
        $this->promo_id = null;
        $this->isEditMode = false;
        $this->selectedMenus = []; 
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
    }

    public function store()
    {
        // 1. Validasi Input (Tanpa kode_promo)
        $this->validate();

        $imagePath = null;
        if ($this->gambar) {
            $imagePath = $this->gambar->store('promos', 'public');
        }

        // 2. [BARU] Auto-Generate Kode Promo
        // Format: PRM-ABCD (PRM + 4 huruf acak kapital)
        $autoCode = 'PRM-' . strtoupper(Str::random(4));

        // Pastikan kode unik (opsional, tapi baik untuk keamanan)
        while(Promo::where('kode_promo', $autoCode)->exists()){
            $autoCode = 'PRM-' . strtoupper(Str::random(4));
        }

        // 3. Simpan ke Database
        $promo = Promo::create([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'kode_promo' => $autoCode, // <--- Pakai variabel autoCode
            'persentase_diskon' => $this->persentase_diskon,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_berakhir' => $this->tanggal_berakhir,
            'status' => $this->status,
            'gambar' => $imagePath,
        ]);

        $promo->menus()->sync($this->selectedMenus);

        // Tampilkan kode di pesan flash agar admin tahu
        session()->flash('message', 'Promo berhasil dibuat! Kode Otomatis: ' . $autoCode);
        
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
        $this->selectedMenus = $promo->menus->pluck('id')->toArray();
        $this->isEditMode = true;
        $this->showForm = true;
    }

    public function update()
    {
        // 1. Validasi Update (Tanpa kode_promo)
        $this->validate([
            // 'kode_promo' dihapus agar tidak error
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

        // 2. Update Database (Tanpa mengubah kode_promo lama)
        $promo->update([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            // 'kode_promo' => $this->kode_promo, <--- JANGAN DI-UPDATE BIAR TIDAK BERUBAH
            'persentase_diskon' => $this->persentase_diskon,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_berakhir' => $this->tanggal_berakhir,
            'status' => $this->status,
            'gambar' => $imagePath,
        ]);

        $promo->menus()->sync($this->selectedMenus);

        session()->flash('message', 'Promo berhasil diperbarui!');
        $this->resetInputFields();
        $this->showForm = false;
    }

    public function delete($id)
    {
        $promo = Promo::find($id);
        if ($promo->gambar) {
            Storage::disk('public')->delete($promo->gambar);
        }
        
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