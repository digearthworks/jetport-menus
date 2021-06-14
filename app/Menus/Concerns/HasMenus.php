<?php

namespace App\Menus\Concerns;

use App\Menus\Models\Menu;
use Illuminate\Support\Collection;

trait HasMenus
{
    /**
     * Remove all current menus and set the given ones.
     *
     * @param  array|\App\Menus\Models\Menu ...$menus
     *
     * @return $this
     */
    public function syncMenus(...$menus)
    {
        $this->menus()->detach();

        return $this->assignMenu($menus);
    }

    /**
     * Assign the given menu to the model.
     *
     * @param array|string|\App\Menus\Models\Menu ...$menus
     *
     * @return $this
     */
    public function assignMenu(...$menus)
    {
        $menus = collect($menus)
            ->flatten()
            ->map(function ($menu) {
                if (empty($menu)) {
                    return false;
                }

                return $this->getStoredMenu($menu);
            })
            ->filter(function ($menu) {
                return $menu instanceof Menu;
            })
            ->map->id
            ->all();

        $model = $this->getModel();

        if ($model->exists) {
            $this->menus()->sync($menus, false);
            $model->load('menus');
        } else {
            $class = \get_class($model);

            $class::saved(
                function ($object) use ($menus, $model) {
                    static $modelLastFiredOn;
                    if ($modelLastFiredOn !== null && $modelLastFiredOn === $model) {
                        return;
                    }
                    $object->menus()->sync($menus, false);
                    $object->load('menus');
                    $modelLastFiredOn = $object;
                }
            );
        }

        return $this;
    }

    protected function getStoredMenu($menu): Menu
    {
        if (is_numeric($menu)) {
            return Menu::find($menu);
        }

        if (is_string($menu)) {
            return Menu::where('uuid', $menu)->first() ?: Menu::where('label', $menu)->first();
        }

        return $menu;
    }

    public function checkIfMenuIsPermitted(Menu $menu): bool
    {
        if (isset($menu->permission) && config('template.auth.check_permissions_on_menu_assignment')) {
            if (!in_array($menu->permission->name, $this->getPermissionNames()->toArray())) {

                // throw new GeneralException(__('This user does not have permission to access this menu.'));
                return false;
            }
        }

        return true;
    }

    public function bookmarks()
    {
        return $this->morphedMenuable()->withTimestamps()->wherePivot('menuable_group', 'bookmarks')->withPivot('menuable_group');
    }

    public function menus()
    {
        return $this->morphedMenuable()->withTimestamps();
    }

    public function hotlinks()
    {
        return $this->morphedMenuable()->where('group', 'hotlinks');
    }

    private function morphedMenuable()
    {
        return $this->morphToMany(Menu::class, 'menuable')->with('children', 'icon')->ordered();
    }

    /**
     * Return all the permissions the model has via roles.
     */
    public function getMenusViaRoles(): Collection
    {
        return $this->loadMissing('roles', 'roles.menus')
            ->roles->flatMap(function ($role) {
                return $role->menus;
            })->sort()->values();
    }

    /**
     * Return all the menus the model has, both directly and via roles.
     */
    public function getAllMenus(): Collection
    {
        /** @var Collection $menus */
        $menus = $this->menus;

        if ($this->roles) {
            $menus = $menus->merge($this->getMenusViaRoles());
        }

        return $menus->sort()->values();
    }

    public function getAllMenusAttribute(): \Illuminate\Support\Collection
    {
        return $this->getAllMenus();
    }

    public function getMenusViaRolesAttribute(): \Illuminate\Support\Collection
    {
        return $this->getMenusViaRoles();
    }

    public function getAllMenusLabel(): string
    {
        if ($this->getAllMenus()->count() === Menu::count()) {
            return 'All';
        }

        if (! $this->getAllMenus()->count() > 0) {
            return 'None';
        }

        return $this->getAllMenus()->pluck('name')->implode('<br/>');
    }

    public function getAllMenusLabelAttribute(): string
    {
        if ($this->getAllMenus()->count() === Menu::count()) {
            return 'All';
        }

        if (! $this->getAllMenus()->count() > 0) {
            return 'None';
        }

        return $this->getAllMenus()->pluck('name')->implode('<br/>');
    }

    public function getAppMenusAttribute(): Collection
    {
        return $this->getAllMenus()->where('group', 'app')->sortBy('sort');
    }
}
