<?php

namespace Turbine\Livewire\Concerns;

use Turbine\Menus\Models\Menu;

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
