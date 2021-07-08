<?php

namespace Turbine\Menus\Actions;

use Turbine\Menus\Models\Menu;

class DeleteMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->delete();
    }
}
