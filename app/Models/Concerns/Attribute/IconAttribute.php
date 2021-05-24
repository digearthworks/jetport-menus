<?php

namespace App\Models\Concerns\Attribute;

trait IconAttribute
{
    public function getArtAttribute(): string
    {
        return $this->html ?? "<i class=\"{$this->class}\"></i>";
    }

    public function getInputAttribute(): string
    {
        return $this->html ?? "$this->class";
    }
}
