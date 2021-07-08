<?php

namespace Turbine\Menus\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self self()
 * @method static self blank()
 * @method static self top()
 */
class MenuItemTargetEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'self' => '_self',
            'blank' => '_blank',
            'top' => '_top',
        ];
    }

    protected static function labels(): array
    {
        return [
            'self' => 'Open In The Same Tab',
            'blank' => 'Open In A New Tab',
            'top' => '_top',
        ];
    }
}
