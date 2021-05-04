<?php

namespace App\MenuSystem\ModelTraits;

use Illuminate\Support\Str;

trait HasPathMethod
{
    public function path()
    {
        return '/' . ($this->uri_prefix ?? Str::slug($this->table)) . '/' . Str::slug($this->getKey());
    }
}
