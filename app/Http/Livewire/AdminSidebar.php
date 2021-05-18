<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminSidebar extends Component
{
    use HasAdminMenus,
        HasAppMenus;

    public bool $adminMenuOpen;

    public bool $appMenuOpen;

    public bool $logsMenuOpen;

    public bool $sidebarOpen;

    public function mount()
    {
        $this->adminMenuOpen = session('adminMenuOpen', false);
        $this->appMenuOpen = session('appMenuOpen', false);
        $this->logsMenuOpen = session('logsMenuOpen', false);
        $this->sidebarOpen = session('sidebarOpen', false);
    }

    public function toggleMenuOpen($sessionKey)
    {
        session()->put($sessionKey, !session($sessionKey, false));
    }

    public function render()
    {
        return view('admin.sidebar', [
            'adminMenuItems' => $this->adminMenus,
            'appMenuItems' => $this->appMenus,
        ]);
    }
}
