<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Edukasi as EdukasiModel;
use Illuminate\Support\Facades\Storage;

class Edukasi extends Component
{
    use WithFileUploads;
    
    // Properti form
    public $judul = '';
    public $konten = '';
    public $image = null;
    public $kategori = '';
    public $ringkasan = '';
    public $selectedId = null;
    
    // Data list
    public $dataEdukasi = [];
    
    // Kategori options
    public $kategoriOptions = [
        'Nutrisi' => 'Nutrisi',
        'Kesehatan' => 'Kesehatan', 
        'Hidup Sehat' => 'Hidup Sehat',
        'Resep' => 'Resep',
        'Sains & Kesehatan' => 'Sains & Kesehatan',
        'Pengetahuan' => 'Pengetahuan',
        'Tren' => 'Tren',
        'Tips' => 'Tips'
    ];

    #[Layout('layouts.admin')]
    #[Title('Manajemen Edukasi')]
    
    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->dataEdukasi = EdukasiModel::latest()->get();
    }

    public function resetForm()
    { 
        $this->reset([
            'judul', 'konten', 'image', 'kategori', 'ringkasan', 'selectedId'
        ]);
        $this->resetValidation();
        $this->image = null;
    }

    public function rules()
    {
        return [
            'judul' => 'required|min:3|max:255',
            'konten' => 'required|min:10',
            'ringkasan' => 'required|min:20|max:200',
            'kategori' => 'required',
            'image' => 'required|image|max:20048',
        ];
    }

 
    private function saveImage($imageFile)
    {
        if (!$imageFile) {
            return null;
        }
        
        try {
            // Buat nama file unik
            $fileName = 'edukasi_' . time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            
            // Simpan dengan path yang PASTI BENAR
            $imageFile->storeAs('edukasi', $fileName, 'public');
            
            // Return path yang benar
            return 'edukasi/' . $fileName;
            
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan gambar: ' . $e->getMessage());
        }
    }

 
    private function deleteOldImage($edukasiId)
    {
        try {
            $oldData = EdukasiModel::find($edukasiId);
            if ($oldData && $oldData->image) {
                // Normalize path - hapus double slash jika ada
                $path = str_replace('//', '/', $oldData->image);
                Storage::disk('public')->delete($path);
            }
        } catch (\Exception $e) {
            // Tidak throw error
        }
    }

    public function save()
    {
        // Validasi
        $this->validate();
        
        try {
            // Data dasar
            $data = [
                'judul' => $this->judul,
                'konten' => $this->konten,
                'kategori' => $this->kategori,
                'ringkasan' => $this->ringkasan,
            ];

            // Handle upload gambar jika ada
            if ($this->image) {
                // Hapus gambar lama jika edit
                if ($this->selectedId) {
                    $this->deleteOldImage($this->selectedId);
                }
                
                // Simpan gambar baru
                $imagePath = $this->saveImage($this->image);
                $data['image'] = $imagePath;
            }

            // CREATE atau UPDATE
            if ($this->selectedId) {
                EdukasiModel::where('id', $this->selectedId)->update($data);
                $message = '✅ Data edukasi berhasil diperbarui.';
            } else {
                EdukasiModel::create($data);
                $message = '✅ Data edukasi berhasil disimpan.';
            }
            
            // Reset & reload
            $this->resetForm(); 
            $this->loadData();
            
            // Success message
            session()->flash('success', $message);
            
        } catch (\Exception $e) {
            session()->flash('error', '❌ ' . $e->getMessage());
        }
    }

    public function edit($id)
    { 
        try {
            $edukasi = EdukasiModel::findOrFail($id);
            
            $this->selectedId = $id; 
            $this->judul = $edukasi->judul; 
            $this->konten = $edukasi->konten;
            $this->kategori = $edukasi->kategori;
            $this->ringkasan = $edukasi->ringkasan;
            $this->image = null;
            
        } catch (\Exception $e) {
            session()->flash('error', '❌ Data tidak ditemukan.');
        }
    }

        public function delete($id)
    { 
        try {
            $edukasi = EdukasiModel::findOrFail($id);
            
            $this->deleteOldImage($id);
            $edukasi->delete();
            $this->loadData();
            session()->flash('success', '✅ Data berhasil dihapus.');
            
        } catch (\Exception $e) {
            session()->flash('error', '❌ Gagal menghapus: ' . $e->getMessage());
        }
    }   

    public function cancelEdit()
    {
        $this->resetForm();
    }


    public function render()
    {
        return view('livewire.edukasi', [
            'dataEdukasi' => $this->dataEdukasi,
            'totalEdukasi' => count($this->dataEdukasi),
        ]);
    }
}