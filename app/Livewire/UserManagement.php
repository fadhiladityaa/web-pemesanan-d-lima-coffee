<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class UserManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $name;
    public $password;
    public $noHp;
    public $role = 'user'; // Default role

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'noHp' => 'required|string|max:15|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $this->name,
            'noHp' => $this->noHp,
            'password' => \Illuminate\Support\Facades\Hash::make($this->password),
            'role' => $this->role,
        ]);

        $this->reset(['name', 'noHp', 'password', 'role']);
        
        session()->flash('message', 'Pengguna berhasil ditambahkan.');
        $this->dispatch('close-modal');
    }

    #[Title('Kelola Pengguna')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.user-management', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('noHp', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10),
        ]);
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        // Menggunakan forceDelete() agar data benar-benar terhapus dari database
        $user = User::find($id);
        if ($user) {
            $user->forceDelete();
        }
        session()->flash('message', 'Pengguna berhasil dihapus.');
    }
}
