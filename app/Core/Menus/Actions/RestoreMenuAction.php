<?php

namespace App\Core\Menus\Actions;

use App\Core\Menus\Models\Menu;

class RestoreMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->restore();
    }
}
