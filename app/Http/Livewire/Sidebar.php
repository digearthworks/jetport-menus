<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Livewire\Component;

class Sidebar extends Component
{
    /**
     * @var Collection|EloquentCollection
     */
    public $appMenuItems;

    /**
     * @var Collection|EloquentCollection
     */
    public $adminMenuItems;

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

        $this->adminMenuItems =  Menu::query()->where('group', 'admin')->get();
        $this->appMenuItems = Menu::query()->where('group', 'app')->get();
    }

    public function toggleMenuOpen($sessionKey)
    {
        session()->put($sessionKey, !session($sessionKey, false));
    }

    public function render()
    {
        return view('sidebar', [
            'adminMenuItems' => $this->adminMenuItems,
            'appMenuItems' => $this->appMenuItems,
        ]);
    }
}
