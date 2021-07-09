<?php

namespace Turbine\Menus\Actions;

use Turbine\Menus\Models\Menu;

class ReactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->activate();
    }
}
