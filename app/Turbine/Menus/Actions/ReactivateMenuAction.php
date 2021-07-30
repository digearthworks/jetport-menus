<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Menus\Models\Menu;

class ReactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->activate();
    }
}
