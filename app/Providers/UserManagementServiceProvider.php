<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.users.edit', 'admin.users.create'], function ($view) {
            $view->with([
                'menus' => Menu::query()->where('menu_id', null)->with('children')->get(),
                'roles' => Role::with('permissions')->get(),
            ]);
        });
    }
}
