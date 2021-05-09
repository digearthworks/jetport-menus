<?php

namespace App\Models\Concerns\Attribute;

/**
 * Trait RoleAttribute.
 */
trait IconAttribute
{
    /**
     * @return string
     */
    public function getArtAttribute(): string
    {
        return $this->svg ?? "<i class=\"{$this->title}\"></i>";
    }
}
