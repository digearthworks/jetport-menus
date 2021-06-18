<?php

namespace App\Core\Menus\Enums;

/**
 * @method static self main_menu()
 * @method static self internal_link()
 * @method static self external_link()
 * @method static self page()
 */
class MenuItemType extends MenuType
{
    protected static function labels(): array
    {
        return array_merge(parent::labels(), [
            'main_menu' => 'Link to Parent Menu',
            'internal_link' => 'Local Link',
            'external_link' => 'External Link',
            'page' => 'Link a Page',
        ]);
    }
}
