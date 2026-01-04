<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class LandingPageManagement extends Component
{
    use \Livewire\WithFileUploads;

    public $images = []; // Untuk upload gambar baru
    public $titles = []; // Untuk judul gambar baru

    #[Title('Kelola Landing Page')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.landing-page-management', [
            'heroes' => \App\Models\LandingHero::orderBy('order')->get()
        ]);
    }

    public function store()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // Max 2MB
            'titles.*' => 'nullable|string|max:255',
        ]);

        foreach ($this->images as $key => $image) {
            if ($image) {
                // Check if we already have 4 images
                if (\App\Models\LandingHero::count() >= 4) {
                    session()->flash('error', 'Maksimal 4 gambar yang diperbolehkan. Hapus gambar lama terlebih dahulu.');
                    return;
                }

                $path = $image->store('landing-heroes', 'public');
                
                \App\Models\LandingHero::create([
                    'image_path' => $path,
                    'title' => $this->titles[$key] ?? null,
                    'order' => \App\Models\LandingHero::count() + 1,
                ]);
            }
        }

        $this->reset(['images', 'titles']);
        session()->flash('message', 'Gambar berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $hero = \App\Models\LandingHero::find($id);
        if ($hero) {
            // Delete file from storage
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($hero->image_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($hero->image_path);
            }
            $hero->delete();
            session()->flash('message', 'Gambar berhasil dihapus.');
        }
    }
}
