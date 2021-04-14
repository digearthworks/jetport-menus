<?php

namespace App\Models\Traits\Relationship;

use App\Models\Icon;
use App\Models\Permission;
use App\Models\User;

/**
 * Class PermissionRelationship.
 */
trait MenuRelationship
{
    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'menu_id')->with('icon', 'parent');
    }

    /**
     * @return mixed
     */
    public function children()
    {
        if ($this->label === 'Menu Index') {
            return $this->whereNotNull('id');
        }

        return $this->hasMany(__CLASS__, 'menu_id')->with('icon', 'children');
    }

    /**
     * @return mixed
     */
    public function hotlinks()
    {
        if ($this->label === 'Menu Index') {
            $this->hasMany(__CLASS__, 'menu_id')->with('icon', 'children')->whereNull('id');
        }

        return $this->hasMany(__CLASS__, 'menu_id')->with('icon', 'children')->where('group', 'hotlinks');
    }

    /**
     * @return mixed
     */
    public function items()
    {
        return $this->hasMany(__CLASS__, 'menu_id')->with('icon', 'children')->where('group', '!=', 'hotlink');
    }

    /**
     * Get all of the users that are assigned this menu.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'menuable');
    }
}
