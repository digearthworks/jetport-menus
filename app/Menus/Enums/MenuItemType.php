<?php

namespace App\Menus\Enums;

class MenuItemType extends MenuType
{
    protected static function labels(): array
    {

        return array_merge(parent::labels(), [
            'main_menu' => 'Link to Parent Menu',
        ]);
    }
}
