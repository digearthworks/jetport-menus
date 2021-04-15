<?php

namespace App\Models\Traits\Attribute;

trait MenuAttribute
{
    /**
     * @param $value
     * @return string
     */
    public function getLabelAttribute($value): string
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

    public function getInternalIframeAttribute(): string
    {
        $prefix = config('ui.internal_iframe_prefix');

        return '/' . $prefix . $this->getInternalLinkAttribute();
    }

    public function getExternalIframeAttribute(): string
    {
        $prefix = config('ui.external_iframe_prefix');

        return '/' . $prefix . '?externallink=' . $this->getCleanSlug();
    }

    public function getInternalLinkAttribute(): string
    {
        return '/' . $this->getCleanSlug();
    }

    public function getDisabledLinkAttribute(): string
    {
        return '#disabled_link#' . $this->getCleanSlug();
    }

    public function getIsActiveAttribute(): bool
    {
        return ($this->attributes['active'] ?? 0) == 1;
    }

    public function getIsIFrameAttribute(): bool
    {
        return ($this->attributes['iframe'] ?? 0) == 1;
    }

    public function getGridAttribute()
    {
        if ($this->isMenuIndex()) {
            return [
                'menu' => $this->reloadWithChildren(),
                'itemsGroupMeta' => $this->getGroupMetaForItems(),
                'rows' => $this->getRowsForMenuIndex(),
            ];
        }

        if ($this->isParentMenu()) {
            return [
                'menu' => $this->reloadWithChildren(),
                'itemsGroupMeta' => $this->getGroupMetaForItems(),
                'rows' => [
                    $this->getChildrenOfRow(1),
                    $this->getChildrenOfRow(2),
                    $this->getChildrenOfRow(3),
                    $this->getChildrenOfRow(4),
                ],
            ];
        }

        return $this->parent->grid;
    }

    private function getChildrenOfRow($int)
    {
        return $this->children()->where('row', $int)->with('icon')->get();
    }

    private function reloadWithChildren()
    {
        return $this->with('children', 'icon')->where('id', $this->id)->first();
    }

    public function setLinkAttribute($link)
    {
        $this->attributes['link'] = ltrim($link, '/');
    }

    public function setIconIdAttribute($icon)
    {
        $this->attributes['icon_id'] = $this->getIconId($icon);
    }

    public function setMenuIdAttribute($menuId)
    {
        // Safety Guard:
        if (!$this->find($menuId) || $this->id == $menuId) {
            $this->attributes['menu_id'] = null;

            return;
        }

        /**
         * If there is already a parent
         * just attach it to the parent
         */
        $this->attributes['menu_id'] = ($this->where('id', $menuId)->value('menu_id') ?: $menuId);
    }

    private function getRowsForMenuIndex()
    {
        $count = $this->whereNotNull('id')->count();
        $collection = collect($this->all());
        $rowCount = $count / 7;
        $chunks = [];
        for ($i = 0; $i < $rowCount; $i++) {
            $chunks[] = $collection->splice(7, 7);
        }

        return array_merge($chunks, [$collection]);
    }

    private function getCleanSlug()
    {
        return $this->cleanSlug($this->attributes['link']);
    }
}
