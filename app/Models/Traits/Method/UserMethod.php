<?php

namespace App\Models\Traits\Method;

use App\Models\Menu;
use Illuminate\Support\Collection;

/**
 * Trait UserMethod.
 */
trait UserMethod
{
    public function isMasterAdmin(): bool
    {
        return $this->id === 1;
    }

    public function isAdmin(): bool
    {
        return $this->type === self::TYPE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->type === self::TYPE_USER;
    }

    public function hasAllAccess(): bool
    {
        return $this->isAdmin() && $this->hasRole(config('jetport.auth.access.role.admin'));
    }

    /**
     * @param $type
     *
     * @return bool
     */
    public function isType($type): bool
    {
        return $this->type === $type;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function isSocial(): bool
    {
        return $this->provider && $this->provider_id;
    }

    /**
     * @return Collection
     */
    public function getPermissionDescriptions(): Collection
    {
        return $this->permissions->pluck('description');
    }

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
                return $this->checkIfMenuIsPermitted($menu) && $menu instanceof Menu;
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
            return Menu::where('label', $menu)->first();
        }

        return $menu;
    }

    public function checkIfMenuIsPermitted(Menu $menu)
    {
        if (isset($menu->permission) && config('jetport.auth.check_permissions_on_menu_assignment')) {
            if (! in_array($menu->permission->name, $this->getPermissionNames()->toArray())) {

                // throw new GeneralException(__('This user does not have permission to access this menu.'));
                return false;
            }
        }

        return true;
    }

    /**
    *  Find whether the model has active clients
    *
    * @return bool
    */
    public function hasActiveClients()
    {
        return $this->clients->where('revoked', 0)->count() > 0;
    }
}
