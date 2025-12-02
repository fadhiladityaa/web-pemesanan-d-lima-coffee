<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Edukasi as EdukasiModel; // <-- TAMBAHKAN ALIAS

class Edukasi extends Component
{
    public $judul, $konten, $selectedId;
    public $dataEdukasi = [];


    #[Layout('layouts.app')]
    #[Title('HalamanEdukasi')]
    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->dataEdukasi = EdukasiModel::latest()->get()->toArray(); // <-- GANTI dengan alias
    }

    public function resetForm()
    { 
        $this->judul = ''; 
        $this->konten = ''; 
        $this->selectedId = null; 
    }

    public function save()
    {
        $this->validate([
            'judul' => 'required',
            'konten' => 'required'
        ]);

        EdukasiModel::create([ // <-- GANTI dengan alias
            'judul' => $this->judul,
            'konten' => $this->konten
        ]);
        
        $this->resetForm(); 
        $this->loadData();
        session()->flash('success', 'Data disimpan.');
    }

    public function edit($id)
    { 
        $d = EdukasiModel::findOrFail($id); // <-- GANTI dengan alias
        $this->selectedId = $id; 
        $this->judul = $d->judul; 
        $this->konten = $d->konten; 
    }

    public function update()
    { 
        $this->validate([
            'judul' => 'required',
            'konten' => 'required'
        ]); 
        
        EdukasiModel::where('id', $this->selectedId)->update([ // <-- GANTI dengan alias
            'judul' => $this->judul,
            'konten' => $this->konten
        ]); 
        
        $this->resetForm(); 
        $this->loadData();
        session()->flash('success', 'Data diperbarui.'); 
    }

    public function delete($id)
    { 
        EdukasiModel::destroy($id); // <-- GANTI dengan alias
        $this->loadData();
        session()->flash('success', 'Data dihapus.'); 
    }

    public function render()
    { 
        return view('livewire.edukasi');
    }
}