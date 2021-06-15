<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class ExternalLink extends MenuLink implements MenuLinkContract
{
    public function getLink() : string
    {
        return $this->getCleanSlug();
    }

    public function getTarget(): string
    {
        return '_blank';
    }
}
