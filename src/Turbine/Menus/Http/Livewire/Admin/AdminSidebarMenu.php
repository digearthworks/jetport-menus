<?php

namespace Turbine\Menus\Http\Livewire\Admin;

use Livewire\Component;
use Turbine\Menus\Models\Menu;

class AdminSidebarMenu extends Component
{
    public bool $sidebarOpen;

    public $menus;

    public $menuOpen = [];

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    public function mount(): void
    {
        $this->menus = Menu::with('children')->ordered()->get();

        /**
         * todo: use recursion instead of hardcoding depth
         *
         * */
        foreach ($this->menus as $menu) {
            $this->setHandleState($menu->handle);
            foreach ($menu->children as $child) {
                $this->setHandleState($child->handle);
                foreach ($child->children as $levelThree) {
                    $this->setHandleState($levelThree->handle);
                }
            }
        }
    }

    public function toggleMenuState($sessionKey): void
    {
        session()->put($sessionKey, ! session($sessionKey, false));
    }

    public function setHandleState($handle)
    {
        $this->menuOpen[$handle] = session($handle, config('turbine.menus.admin_sidebar_default_open', true));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.sidebar-menu');
    }
}
