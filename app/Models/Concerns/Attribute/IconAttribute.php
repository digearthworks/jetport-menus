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

    public function setHtmlAttribute($value)
    {
        if ($value) {
            $this->attributes['html'] = trim(preg_replace( "/\r|\n/", "", $this->repairHtml($value)));
        }
    }

    public function getHtmlAttribute($value)
    {
        return $value ? trim(preg_replace( "/\r|\n/", "", $this->repairHtml($value))) : null;
    }
}
