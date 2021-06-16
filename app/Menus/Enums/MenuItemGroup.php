<?php

namespace App\Menus\Enums;

use Closure;
use Spatie\Enum\Enum;

/**
 * @method static self navigation()
 * @method static self main()
 */
class MenuItemGroup extends Enum
{
    protected static function labels(): Closure
    {
        return function(string $name): string {
            return ucfirst($name);
        };
    }
}
