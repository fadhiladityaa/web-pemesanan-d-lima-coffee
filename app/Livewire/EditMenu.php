<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class EditMenu extends Component
{

    #[Title('Edit Menu')]
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.dashboard.edit-menu');
    }
}
