<?php

namespace App\Turbine\Livewire\Concerns;

use App\Turbine\Menus\Models\Menu;

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
