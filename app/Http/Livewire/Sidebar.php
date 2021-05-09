<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;

class Sidebar extends Component
{
    public $officeItems;

    public $adminItems;

    public $adminOpen;

    public $officeOpen;

    public $logsOpen;

    public $sidebarOpen;

    public function mount()
    {
        $this->adminOpen = session('adminOpen', false);
        $this->officeOpen = session('officeOpen', false);
        $this->logsOpen = session('logsOpen', false);
        $this->sidebarOpen = session('sidebarOpen', false);

        $this->adminItems =  Menu::query()->where('group', 'admin')->get();
        $this->officeItems = Menu::query()->where('group', 'office')->get();
    }

    public function toggleAdminOpen()
    {
        $adminOpen = session('adminOpen', false);

        session()->put('adminOpen', !$adminOpen);
    }

    public function toggleOfficeOpen()
    {
        $officeOpen = session('officeOpen', false);

        session()->put('officeOpen', !$officeOpen);
    }

    public function toggleLogsOpen()
    {
        $logsOpen = session('logsOpen', false);

        session()->put('logsOpen', !$logsOpen);
    }

    public function render()
    {
        return view('sidebar', [
            'adminItems' => $this->adminItems,
            'officeItems' => $this->officeItems,
        ]);
    }
}
