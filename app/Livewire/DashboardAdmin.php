<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


class DashboardAdmin extends Component
{

    #[Layout('layouts.admin')]
    #[Title('create menu')]
    public function render()
    {
        return view('livewire.dashboard-admin');
    }
}