<?php

namespace App\Http\Livewire\Concerns;

use App\Menus\Models\Menu;

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
