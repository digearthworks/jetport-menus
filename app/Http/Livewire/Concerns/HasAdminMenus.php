<?php

namespace App\Http\Livewire\Concerns;

use App\Models\Menu;

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
