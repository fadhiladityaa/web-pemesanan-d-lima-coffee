<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class AdminProfile extends Component
{
    public $name;
    public $noHp;

    public $current_password;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->noHp = $user->noHp;
    }

    #[Title('Pengaturan Profil')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin-profile');
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'noHp' => 'required|string|max:15|unique:users,noHp,' . Auth::id(),
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'noHp' => $this->noHp,
        ]);

        session()->flash('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password saat ini tidak sesuai.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);
        session()->flash('password_success', 'Password berhasil diubah.');
    }
}
