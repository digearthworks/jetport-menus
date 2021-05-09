<?php

namespace App\Models\Concerns;

use App\Models\Menu;

trait HasMenus
{
    /**
     * Remove all current menus and set the given ones.
     *
     * @param  array|\App\Models\Menu ...$menus
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
     * @param array|string|\App\Models\Menu ...$menus
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

    public function checkIfMenuIsPermitted(Menu $menu)
    {
        if (isset($menu->permission) && config('jetport.auth.check_permissions_on_menu_assignment')) {
            if (!in_array($menu->permission->name, $this->getPermissionNames()->toArray())) {

                // throw new GeneralException(__('This user does not have permission to access this menu.'));
                return false;
            }
        }

        return true;
    }

    public function bookmarks()
    {
        return $this->morphedMenuable()->withTimestamps()->wherePivot('menuable_group', 'bookmarks');
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
        return $this->morphToMany(Menu::class, 'menuable')->orderBy('sort')->with('children', 'icon');
    }
}