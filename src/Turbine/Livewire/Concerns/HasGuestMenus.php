<?php

namespace Turbine\Livewire\Concerns;

use Turbine\Menus\Models\Menu;

trait HasGuestMenus
{
    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getGuestMenusProperty()
    {
        return Menu::forGuest()->get();
    }
}
