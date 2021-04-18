<?php

namespace App\MenuSystem;

use Illuminate\Support\Facades\Gate;

class MenuGates
{
    public static function define()
    {
        Gate::define('any_menus_permission', function ($user = null) {
            // return true if access to web tinker is allowed
            return $user->hasAnyPermission([
                'admin.access.menus.create',
                'admin.access.menus.edit',
                'admin.access.menus.delete'
            ]);
        });

    }

}
