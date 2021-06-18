<?php

namespace App\Core\Menus\Enums;

use Closure;
use Spatie\Enum\Enum;

/**
 * @method static self app()
 * @method static self admin()
 * @method static self guest()
 */
class MenuGroup extends Enum
{
    protected static function labels(): Closure
    {
        return function (string $name): string {
            return ucfirst($name);
        };
    }
}
