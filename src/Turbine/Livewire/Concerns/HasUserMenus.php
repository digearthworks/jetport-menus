<?php

namespace Turbine\Livewire\Concerns;

use Turbine\Menus\Models\Menu;

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
