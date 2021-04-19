<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;

class Sidebar extends Component
{
    /**
     * The items in the sidebar.
     *
     * @var array
     */
    public $officeItems;
    public $adminItems;

    public function mount($navItems = [])
    {
        $this->adminItems =  Menu::query()->where('group', 'admin')->get();
        $this->officeItems = Menu::query()->where('group', 'office')->get();
    }

    public function render()
    {
        return view('sidebar', [
            'adminItems' => $this->adminItems,
            'officeItems' => $this->officeItems,
        ]);
    }

    private function randomItems()
    {
        return explode(' ', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.');
    }
}
