<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminSidebarToggler extends Component
{
    public $sidebarOpen;

    public function mount(): void
    {
        $this->sidebarOpen = session('sidebarOpen', false);
    }

    public function toggleSidebarOpen(): void
    {
        $sidebarOpen = session('sidebarOpen', false);

        session()->put('sidebarOpen', !$sidebarOpen);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.includes.sidebar-toggler');
    }
}
