<?php

namespace App\Core\Menus\Actions;

use App\Core\Menus\Models\Menu;

class ReactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->activate();
    }
}
