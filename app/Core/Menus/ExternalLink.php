<?php

namespace App\Core\Menus;

use App\Core\Menus\Contracts\MenuLinkContract;

class ExternalLink extends MenuLink implements MenuLinkContract
{
    public function getPath() : string
    {
        return $this->getCleanSlug();
    }

    public function getTarget(): string
    {
        return '_blank';
    }
}
