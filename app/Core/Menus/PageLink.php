<?php

namespace App\Core\Menus;

use App\Core\Menus\Contracts\MenuLinkContract;

class PageLink extends MenuLink implements MenuLinkContract
{
    public function getPath() : string
    {
        return config('menus.url_segments.pages_prefix') . $this->menu->Page->slug;
    }
}
