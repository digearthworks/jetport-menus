<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $app_logo = config('ui.logo');

            if (app()->environment(['testing', 'local'])) {
                $app_logo = '/stock-img/' . Storage::disk('stock-img')->files()[
                    rand(0, (count(Storage::disk('stock-img')->files()) - 1))
                ];
            }

            $view->with([
                'app_logo' => $app_logo,
                'logged_in_user' => auth()->user()
            ]);
        });

        View::composer(['admin.users.edit', 'admin.users.create'], function ($view) {
            $view->with([
                'menus' => Menu::query()->where('menu_id', null)->with('children')->get(),
                'roles' => Role::with('permissions')->get(),
                'generalPermissions' => Permission::query()->doesntHave('parent')->doesntHave('children')->get(),
                'permissionCategories' => Permission::query()->whereHas('children')->with('children')->get(),
            ]);
        });

        View::composer(['admin.roles.edit', 'admin.roles.create'], function ($view) {
            $view->with([
                'permissions' => Permission::query()->with('children')->get(),
                'generalPermissions' => Permission::query()->doesntHave('parent')->doesntHave('children')->get(),
                'permissionCategories' => Permission::query()->whereHas('children')->with('children')->get(),
            ]);
        });

        View::composer(['admin.permissions.type'], function ($view) {
            $view->with([
                'generalPermissions' => Permission::query()->doesntHave('parent')->doesntHave('children')->get(),
                'permissionCategories' => Permission::query()->whereHas('children')->with('children')->get(),
            ]);
        });
    }
}
