<?php

namespace App\Turbine\Facades;

use Illuminate\App\TurbineFacades\Facade;
use Support\Blink as TurbineBlink;

/**
 * @method static mixed|\Spatie\Blink\Blink store($name = 'default')
 *
 * @see Statamic\Support\Blink
 */
class Blink extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TurbineBlink::class;
    }
}
