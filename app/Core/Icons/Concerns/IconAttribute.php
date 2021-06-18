<?php

namespace App\Core\Icons\Concerns;

use App\Core\Support\TidyHtml;

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

    public function setHtmlAttribute($value): void
    {
        if ($value) {
            $this->attributes['html'] = trim(preg_replace("/\r|\n/", "", (new TidyHtml($value))->html));
        }
    }

    public function getHtmlAttribute($value): ?string
    {
        return $value ? trim(preg_replace("/\r|\n/", "", (new TidyHtml($value))->html)) : null;
    }

    /**
     * @return string
     */
    public function getMetaLabelAttribute(): string
    {
        return collect(explode(' ', $this->meta ?? ''))
            ->implode('<br/>');
    }

    /**
     * @return string
     */
    public function getMenusLabelAttribute(): string
    {
        return collect($this->menus()->pluck('name')->toArray())
            ->implode('<br/>');
    }
}
