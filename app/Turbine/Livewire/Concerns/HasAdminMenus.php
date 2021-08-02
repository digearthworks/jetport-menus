<?php

namespace App\Turbine\Livewire\Concerns;

use App\Turbine\Menus\Models\Menu;

trait HasAdminMenus
{
    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAdminMenusProperty()
    {
        return Menu::forAdmin()->get();
    }
}
