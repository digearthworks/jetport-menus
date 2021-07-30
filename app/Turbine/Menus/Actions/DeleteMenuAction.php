<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Menus\Models\Menu;

class DeleteMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->delete();
    }
}
