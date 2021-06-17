<?php

namespace App\Menus\Actions;

use App\Menus\Models\Menu;

class RestoreMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->restore();
    }
}
