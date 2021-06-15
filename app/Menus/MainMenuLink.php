<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class MainMenuLink extends MenuLink implements MenuLinkContract
{
    public function getLink() : string
    {
        return $this->menu->path();
    }
}
