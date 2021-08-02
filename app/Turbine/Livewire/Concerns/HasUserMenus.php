<?php

namespace App\Turbine\Livewire\Concerns;

use App\Turbine\Menus\Models\Menu;

trait HasUserMenus
{
    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getUserMenusProperty()
    {
        return Menu::forUsers()->get();
    }
}
