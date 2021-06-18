<?php

namespace App\Core\Livewire\Concerns;

use App\Core\Menus\Models\Menu;

trait HasAppMenus
{

    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAppMenusProperty()
    {
        return Menu::app()->get();
    }
}
