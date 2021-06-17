<?php

namespace App\Menus\Actions;

use App\Menus\Models\Menu;

class ReactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->activate();
    }
}
