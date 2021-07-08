<?php

namespace Turbine\Menus\Actions;

use Turbine\Menus\Models\Menu;

class RestoreMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->restore();
    }
}
