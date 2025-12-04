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
    
    #[Layout('layouts.app')] // PASTIKAN LAYOUT ADA
    #[Title('Edukasi Kesehatan & Nutrisi - D\'Lima Coffee')] // TITLE LENGKAP
    
    public $search = '';
    public $kategoriFilter = '';
    public $selectedEdukasi = null;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'kategoriFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingKategoriFilter()
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
        $edukasiList = Edukasi::query()
            ->when($this->search, function ($query) {
                return $query->where(function($q) {
                    $q->where('judul', 'like', '%' . $this->search . '%')
                      ->orWhere('konten', 'like', '%' . $this->search . '%')
                      ->orWhere('ringkasan', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->kategoriFilter, function ($query) {
                return $query->where('kategori', $this->kategoriFilter);
            })
            ->latest()
            ->paginate(9);

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