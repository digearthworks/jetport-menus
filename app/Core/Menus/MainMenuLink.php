<?php

namespace App\Core\Menus;

use App\Core\Menus\Contracts\MenuLinkContract;

class MainMenuLink extends MenuLink implements MenuLinkContract
{
    public function getPath() : string
    {
        return $this->menu->path();
    }
}
