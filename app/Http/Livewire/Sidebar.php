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
    public $navItems;

    public function mount($navItems = [])
    {
        if (!count($navItems) > 0) {
            $this->navItems = explode(' ', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.');
        }
    }

    public function render()
    {
        return view('sidebar', [
            'navItems' => $this->navItems,
        ]);
    }
}
