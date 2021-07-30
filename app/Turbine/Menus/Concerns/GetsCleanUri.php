<?php

namespace App\Turbine\Menus\Concerns;

trait GetsCleanUri
{
    protected function getCleanUri(string $value)
    {
        return ltrim(str_replace(array_values(config('turbine.dirty_routes', [])), '', $value), '/');
    }
}
