<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminSidebarToggler extends Component
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
        return view('admin.includes.sidebar-toggler');
    }
}
