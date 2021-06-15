<?php

namespace App\Menus\Options;

class MenuItemLinkType extends MenuLinkType
{
    protected static function labels(): array
    {
        return [
            'main_menu' => 'Menu',
            'internal_link' => 'Local Link',
            'external_link' => 'External Link',
            'page' => 'Link a Page',
        ];
    }
}
