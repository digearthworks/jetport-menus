<?php

namespace App\Menus\Actions;

use App\Menus\Models\Menu;

class DeactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->deactivate();
    }
}
