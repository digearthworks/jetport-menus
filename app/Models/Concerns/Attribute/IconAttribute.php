<?php

namespace App\Models\Concerns\Attribute;

trait IconAttribute
{
    /**
     * @return string
     */
    public function getArtAttribute(): string
    {
        return $this->html ?? "<i class=\"{$this->class}\"></i>";
    }
}
