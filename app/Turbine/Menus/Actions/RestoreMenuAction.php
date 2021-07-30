<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Menus\Models\Menu;

class RestoreMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->restore();
    }
}
