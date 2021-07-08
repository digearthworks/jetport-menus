<?php

namespace Turbine\Menus\Actions;

use Turbine\Menus\Models\Menu;

class DeactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->deactivate();
    }
}
