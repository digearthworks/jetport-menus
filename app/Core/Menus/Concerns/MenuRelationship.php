<?php

namespace App\Core\Menus\Concerns;

use App\Core\Auth\Models\User;
use App\Core\Icons\Models\Icon;

trait MenuRelationship
{
    public function icon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'menu_id')->with('icon', 'parent')->withTrashed();
    }

    public function isParentMenu(): bool
    {
        return $this->menu_id === null;
    }

    public function children()
    {
        return $this->getChildrenQuery();
    }

    public function getChildrenQuery()
    {
        return $this->hasMany(__CLASS__, 'menu_id')->ordered();
    }

    public function navigation()
    {
        return $this->getChildrenQuery()->where('group', 'navigation');
    }

    public function items()
    {
        return $this->getChildrenQuery()->where('group', '!=', 'hotlink');
    }

    /**
     * Get all of the users that are assigned this menu.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'menuable');
    }

    public function usersFromRoles()
    {
        return User::role($this->roles()->pluck('name'));
    }

    public function getAllUsers()
    {
        return $this->users->merge($this->usersFromRoles());
    }

    public function getAllUsersAttribute()
    {
        return $this->getAllUsers();
    }

    public function getAllUsersCountAttribute()
    {
        return $this->getAllUsers()->count();
    }
}
