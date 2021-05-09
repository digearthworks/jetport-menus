<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SidebarToggler extends Component
{
    public $sidebarOpen;

    public function mount()
    {
        $this->sidebarOpen = session('sidebarOpen', false);
    }

    public function toggleSidebarOpen()
    {
        $sidebarOpen = session('sidebarOpen', false);

        session()->put('sidebarOpen', !$sidebarOpen);
    }

    public function render()
    {
        return view('includes.sidebar-toggler');
    }
}
