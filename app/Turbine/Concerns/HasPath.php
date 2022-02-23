<?php

namespace App\Turbine\Concerns;

use Illuminate\Support\Str;

trait HasPath
{
    /**
     * @return string
     */
    public function path(): string
    {
        return '/'.($this->uri_prefix ?? Str::slug($this->table)).'/'.Str::slug($this->getKey());
    }
}
