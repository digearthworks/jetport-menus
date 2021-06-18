<?php

namespace App\Core\Menus\Actions;

use App\Core\Menus\Models\Menu;

class DeactivateMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->deactivate();
    }
}
