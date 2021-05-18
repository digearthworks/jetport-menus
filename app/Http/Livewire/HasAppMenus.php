<?php

namespace App\Http\Livewire;

use App\Models\Menu;

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
