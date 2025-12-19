<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Edukasi;

class EdukasiPelanggan extends Component
{
    use WithPagination;
    
    #[Layout('layouts.app')] 
    #[Title('Edukasi Kesehatan & Nutrisi - D\'Lima Coffee')] 
    
    // Variabel Search
    public $search = '';
    
    // Variabel Filter Kategori
    public $kategoriFilter = '';
    
    // Variabel Detail
    public $selectedEdukasi = null;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'kategoriFilter' => ['except' => ''],
    ];

    /**
     * PENTING: Fungsi ini berjalan otomatis setiap kali Anda mengetik di kolom pencarian.
     * Ini yang membuat fitur pencarian menjadi responsif dan tidak error saat pindah halaman.
     */
    public function updatedSearch()
    {
        $this->resetPage(); // Kembali ke halaman 1 setiap kali mengetik
    }

    public function updatedKategoriFilter()
    {
        $this->resetPage();
    }

    public function showDetail($id)
    {
        $this->selectedEdukasi = Edukasi::find($id);
    }

    public function closeDetail()
    {
        $this->selectedEdukasi = null;
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->kategoriFilter = '';
        $this->resetPage();
    }

    public function render()
    {
        // Query Dasar
        $query = Edukasi::query();

        // 1. FILTER PENCARIAN (KHUSUS JUDUL)
        if ($this->search) {
            // Kita hanya mencari di kolom 'judul' sesuai permintaan
            $query->where('judul', 'like', '%' . $this->search . '%');
        }

        // 2. FILTER KATEGORI
        if ($this->kategoriFilter) {
            $query->where('kategori', $this->kategoriFilter);
        }

        // Ambil data terbaru dan pagination
        $edukasiList = $query->latest()->paginate(9);

        // Ambil daftar kategori untuk tombol filter
        $kategoriList = Edukasi::distinct('kategori')
            ->whereNotNull('kategori')
            ->pluck('kategori');

        return view('livewire.edukasi-pelanggan', [
            'edukasiList' => $edukasiList,
            'kategoriList' => $kategoriList,
            'totalEdukasi' => Edukasi::count(),
        ]);
    }
}