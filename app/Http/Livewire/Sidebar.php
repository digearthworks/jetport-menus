<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    /**
     * The items in the sidebar.
     *
     * @var array
     */
    public $navItems = [];

    public function mount($navItems = [])
    {
        if (! $navItems) {
            $this->navItems = $this->randomItems();
        }
    }

    public function render()
    {
        return view('sidebar', [
            'navItems' => $this->navItems,
        ]);
    }

    private function randomItems()
    {
        return explode(' ', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.');
    }
}
