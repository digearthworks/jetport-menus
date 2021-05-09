<?php

namespace App\Models\Concerns\Method;

use Illuminate\Support\Str;

trait PathMethod
{
    /**
     * @return string
     */
    public function path(): string
    {
        return '/' . ($this->uri_prefix ?? Str::slug($this->table)) . '/' . Str::slug($this->getKey());
    }
}
