<?php

namespace App\Models\Traits\Method;

use Illuminate\Support\Str;

/**
 * Trait HasPathMethod.
 */
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
