<?php

namespace App\Http\Livewire\Concerns;

use App\Core\Menus\Models\Menu;

trait HasAdminMenus
{

    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAdminMenusProperty()
    {
        return Menu::admin()->get();
    }
}
