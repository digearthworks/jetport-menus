<?php

namespace App\Turbine\Menus\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminNavigationMenu extends Component
{
    public $menus;

    public $menuOpen = [];

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => 'render',
    ];

    public function toggleMenuState($sessionKey): void
    {
        session()->put($sessionKey, ! session($sessionKey, false));
    }

    public function setHandleState($handle)
    {
        $this->menuOpen[$handle] = session($handle, config('turbine.menus.admin_sidebar_default_open', true));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->menus = Auth::user()->getAllMenus();

        /**
         * todo: use recursion instead of hardcoding depth
         *
         * */
        foreach ($this->menus as $menu) {
            $this->setHandleState($menu->handle . '-navbar');
            foreach ($menu->children as $child) {
                $this->setHandleState($child->handle . '-navbar');
                foreach ($child->children as $levelThree) {
                    $this->setHandleState($levelThree->handle . '-navbar');
                }
            }
        }

        return view('admin.navigation-menu');
    }
}
