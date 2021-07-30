<?php

namespace App\Turbine\Menus\Actions;

use App\Turbine\Menus\Models\Menu;

class DeactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->deactivate();
    }
}
