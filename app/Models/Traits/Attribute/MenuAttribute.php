<?php

namespace App\Models\Traits\Attribute;

trait MenuAttribute
{

    public function getLabelAttribute($value)
    {
        return ucfirst($value);
    }

    public function getPathAttribute()
    {
        return $this->path();
    }


    public function getLinkAttribute($value)
    {
        if (!$this->is_active) {
            return $this->disabled_link;
        }

        if ($this->type === 'main_menu' && !$this->menu_id > 0) {
            return $this->path();
        }

        if ($this->type === 'main_menu' && $this->menu_id > 0) {
            return $this->parent->path;
        }

        if ($this->isIframe && $this->type === 'internal_link') {
            return $this->internal_iframe;
        }

        if ($this->isIframe && $this->type === 'external_link') {
            return $this->external_iframe;
        }

        if ($this->type === 'internal_link') {
            return $this->internal_link;
        }

        if ($this->type === 'external_link') {
            return $this->cleanSlug($value);
        }

        return $value;
    }

    public function getInternalIframeAttribute()
    {
        $prefix = config('ui.internal_iframe_prefix');
        $link = $this->attributes['link'];

        return '/' . $prefix . '/' . $this->cleanSlug($link);
    }

    public function getExternalIframeAttribute()
    {
        $prefix = config('ui.external_iframe_prefix');
        $link = $this->attributes['link'];

        return '/' . $prefix . '?externallink=' . $this->cleanSlug($link);
    }

    public function getInternalLinkAttribute()
    {
        return '/' . $this->cleanSlug($this->attributes['link']);
    }

    public function getDisabledLinkAttribute()
    {
        return '#disabled_link#' . $this->cleanSlug($this->attributes['link']);
    }

    public function getIsActiveAttribute()
    {
        if (isset($this->attributes['active']) && $this->attributes['active'] == 1) {
            return true;
        }

        return false;
    }

    public function getIsIFrameAttribute()
    {
        if (isset($this->attributes['iframe']) && $this->attributes['iframe'] == 1) {
            return true;
        }

        return false;
    }

    public function getGridAttribute()
    {
        if ($this->label === 'Menu Index') {
            $count = $this->whereNotNull('id')->count();
            $collection = collect($this->all());
            $rowCount = $count / 7;
            $chunks = [];
            for ($i = 0 ; $i < $rowCount; $i++) {
                $chunks[] = $collection->splice(7, 7);
            }
            $rows = array_merge($chunks, [$collection]);

            return [
                'menu' => $this->with('children', 'icon')->where('id', $this->id)->first(),
                'itemsGroupMeta' => $this->getGroupMetaForItems(),
                'rows' => $rows,
            ];
        }

        if ($this->menu_id === null) {
            return [
                'menu' => $this->with('children', 'icon')->where('id', $this->id)->first(),
                'itemsGroupMeta' => $this->getGroupMetaForItems(),
                'rows' => [
                    $this->children()->where('row', 1)->with('icon')->get(),
                    $this->children()->where('row', 2)->with('icon')->get(),
                    $this->children()->where('row', 3)->with('icon')->get(),
                    $this->children()->where('row', 4)->with('icon')->get(),
                ],
            ];
        }

        return $this->parent->grid;
    }

    public function setLinkAttribute($link)
    {
        $this->attributes['link'] = ltrim($link, '/');
    }

    public function setIconIdAttribute($icon)
    {
        $this->attributes['icon_id'] = $this->getIconId($icon);
    }

}
