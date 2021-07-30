<?php

namespace App\Turbine\Menus\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use App\Turbine\Menus\Models\Menu;
use App\Turbine\Menus\Models\MenuItem;

trait HasMenuItems
{
    /**
     * Remove all current menuItems and set the given ones.
     *
     * @param  array|\App\Turbine\MenuItems\Models\Menu ...$menuItems
     *
     * @return $this
     */
    public function syncMenuItems(...$menuItems)
    {
        $this->menuItems()->detach();

        return $this->assignMenuItem($menuItems);
    }

    /**
     * Remove all current menuItems and set the given ones.
     *
     * @param  array|\App\Turbine\MenuItems\Models\Menu ...$menuItems
     *
     * @return $this
     */
    public function syncMenus(...$menuItems)
    {
        return $this->syncMenuItems($menuItems);
    }

    /**
     * Remove all current menuItems and set the given ones.
     *
     * @param  array|\App\Turbine\MenuItems\Models\Menu ...$menuItems
     *
     * @return $this
     */
    public function assignMenu(...$menuItems)
    {
        return $this->assignMenuItem($menuItems);
    }

    /**
     * Assign the given menu item to the model.
     *
     * @param array|string|\App\Turbine\MenuItems\Models\MenuItem ...$menuItems
     *
     * @return $this
     */
    public function assignMenuItem(...$menuItems)
    {
        $menuItems = collect($menuItems)
            ->flatten()
            ->map(function ($menuItem) {
                if (empty($menuItem)) {
                    return false;
                }

                return $this->getStoredMenu($menuItem);
            })
            ->filter(function ($menuItem) {
                return $menuItem instanceof MenuItem;
            })
            ->map->id
            ->all();

        $model = $this->getModel();

        if ($model->exists) {
            $this->menuItems()->sync($menuItems, false);
            $model->load('menuItems');
        } else {
            $class = \get_class($model);

            $class::saved(
                function ($object) use ($menuItems, $model) {
                    static $modelLastFiredOn;
                    if ($modelLastFiredOn !== null && $modelLastFiredOn === $model) {
                        return;
                    }
                    $object->menuItems()->sync($menuItems, false);
                    $object->load('menuItems');
                    $modelLastFiredOn = $object;
                }
            );
        }

        return $this;
    }

    protected function getStoredMenu($menu): MenuItem
    {
        if (is_numeric($menu)) {
            return MenuItem::find($menu);
        }

        if (is_string($menu)) {
            return MenuItem::where('uuid', $menu)->first() ?: MenuItem::where('name', $menu)->first();
        }

        return $menu;
    }

    public function bookmarks()
    {
        return $this->morphedMenuable()->withTimestamps()->wherePivot('menuable_group', 'bookmarks')->withPivot('menuable_group');
    }

    public function menuItems()
    {
        return $this->morphedMenuable()->withTimestamps();
    }

    public function navigation()
    {
        return $this->morphedMenuable()->where('group', 'navigation');
    }

    private function morphedMenuable()
    {
        return $this->morphToMany(MenuItem::class, 'menuable')->onlyActive()->with('children', 'icon', 'parentItem', 'page')->ordered();
    }

    /**
     * Return all the permissions the model has via roles.
     */
    public function getMenuItemsViaRoles(): Collection
    {
        return $this->loadMissing('roles', 'roles.menuItems')
            ->roles->flatMap(function ($role) {
                return $role->menuItems;
            })->sort()->values();
    }

    /**
     * Return all the menuItems the model has, both directly and via roles.
     */
    public function getAllMenuItems(): Collection
    {
        /** @var Collection $menuItems */
        $menuItems = $this->menuItems;

        if ($this->roles) {
            $menuItems = $menuItems->merge($this->getMenuItemsViaRoles());
        }

        return $menuItems->sortBy('sort')->values();
    }

    public function getAllMenuItemsAttribute(): \Illuminate\Support\Collection
    {
        return $this->getAllMenuItems();
    }

    public function getMenuItemsViaRolesAttribute(): \Illuminate\Support\Collection
    {
        return $this->getMenuItemsViaRoles();
    }

    public function getAllMenuItemsLabel(): string
    {
        if ($this->getAllMenuItems()->count() === MenuItem::count()) {
            return 'All';
        }

        if (! $this->getAllMenuItems()->count() > 0) {
            return 'None';
        }

        return $this->getAllMenuItems()->pluck('name')->implode('<br/>');
    }

    public function getAllMenuItemsLabelAttribute(): string
    {
        if ($this->getAllMenuItems()->count() === MenuItem::count()) {
            return 'All';
        }

        if (! $this->getAllMenuItems()->count() > 0) {
            return 'None';
        }

        return $this->getAllMenuItems()->pluck('name')->implode('<br/>');
    }

    public function menus(): Builder
    {
        $menuIds = $this->getAllMenuItems()->pluck('menu_id')->toArray();
        $ids = $this->getAllMenuItems()->pluck('id')->toArray();

        return Menu::whereIn('id', $menuIds)->with('children', function ($query) use ($ids) {
            return $query->whereIn('id', $ids);
        });
    }

    public function getAllMenus(): Collection
    {
        $menuIds = $this->getAllMenuItems()->pluck('menu_id')->toArray();
        // $ids = $this->getAllMenuItems()->pluck('id')->toArray();

        return Menu::whereIn('id', $menuIds)->with('children', 'authChildren')->ordered()->get();
    }

    public function syncMenusWithChildren(array $menuItemIds = [])
    {
        $itemsWithChildren = [];

        foreach ($menuItemIds as $item) {
            $itemsWithChildren = array_merge(
                $itemsWithChildren,
                (MenuItem::find($item)->children->pluck('id')->toArray() ?? []),
                [$item]
            );
        }

        $this->syncMenuItems($itemsWithChildren);
    }
}
