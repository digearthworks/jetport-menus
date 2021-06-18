<?php

namespace App\Core\Menus\Actions;

use App\Core\Menus\Models\Menu;

class DeleteMenuAction
{
    public function __invoke(Menu $menu)
    {
        $menu->delete();
    }
}
