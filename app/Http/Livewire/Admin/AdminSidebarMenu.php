<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Concerns\HasAdminMenus;
use App\Http\Livewire\Concerns\HasAppMenus;
use Livewire\Component;

class AdminSidebarMenu extends Component
{
    use HasAdminMenus,
        HasAppMenus;

    public bool $adminMenuOpen;

    public bool $appMenuOpen;

    public bool $logsMenuOpen;

    public bool $sidebarOpen;

    public function mount()
    {
        $this->adminMenuOpen = session('adminMenuOpen', config('ui.admin_sidebar_default_open', true ));
        $this->appMenuOpen = session('appMenuOpen', config('ui.admin_sidebar_default_open', true ));
        $this->logsMenuOpen = session('logsMenuOpen', config('ui.admin_sidebar_default_open', true ));
        $this->sidebarOpen = session('sidebarOpen', config('ui.admin_sidebar_default_open', true ));
    }

    public function toggleMenuOpen($sessionKey)
    {
        session()->put($sessionKey, !session($sessionKey, false));
    }

    public function render()
    {
        return view('admin.sidebar-menu', [
            'adminMenuItems' => $this->adminMenus,
            'appMenuItems' => $this->appMenus,
        ]);
    }
}
