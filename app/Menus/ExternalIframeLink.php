<?php

namespace App\Menus;

use App\Menus\Contracts\MenuLinkContract;

class ExternalIframeLink extends MenuLink implements MenuLinkContract
{
    public function getPath() : string
    {
        $prefix = config('menus.url_segments.external_iframe_prefix');

        return '/' . $prefix . config('menus.url_segments.external_link_query') . $this->getCleanSlug();
    }

    public function getTarget(): string
    {
        return '_blank';
    }
}
