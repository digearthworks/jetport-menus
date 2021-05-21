<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminNavigationMenu extends Component
{
    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-admin-navigation-menu' => '$refresh',
    ];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('admin.navigation-menu');
    }
}
