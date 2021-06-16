<?php

namespace App\Menus\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self main_menu()
 * @method static self internal_link()
 * @method static self external_link()
 * @method static self page()
 */
class MenuType extends Enum
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
