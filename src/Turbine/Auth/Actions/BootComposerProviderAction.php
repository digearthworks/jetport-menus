<?php

namespace Turbine\Auth\Actions;

use Auth;
use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\Models\Permission;
use Turbine\Auth\Models\Role;
use Turbine\Menus\Models\MenuItem;
use View;

class BootComposerProviderAction
{
    public function __invoke()
    {
        $this->bootComposer();
    }

    private function bootComposer()
    {
        View::composer('*', function ($view) {
            $view->with([
                'logged_in_user' => Auth::user(),
            ]);
        });

        View::composer('admin.permissions.admin-checklist', function ($view) {
            $generalAdminPermissions = Permission::query()->doesntHave('parent')
                ->doesntHave('children')
                ->where('type', UserTypeEnum::admin())
                ->get() ?? [];

            $adminPermissionCategories = Permission::query()
                ->whereHas('children')
                ->with('children')
                ->where('type', UserTypeEnum::admin())
                ->get() ?? [];

            $view->with([
                'generalAdminPermissions' => $generalAdminPermissions,
                'adminPermissionCategories' => $adminPermissionCategories,
            ]);
        });

        View::composer('admin.permissions.user-checklist', function ($view) {
            $view->with([
                'generalUserPermissions' => Permission::query()
                    ->doesntHave('parent')
                    ->doesntHave('children')
                    ->where('type', UserTypeEnum::user())
                    ->get() ?? [],
                'userPermissionCategories' => Permission::query()
                    ->whereHas('children')->with('children')
                    ->where('type', UserTypeEnum::user())
                    ->get() ?? [],
            ]);
        });

        View::composer(['admin.menus.user-checklist', 'admin.users.create', 'admin.users.edit'], function ($view) {
            $view->with([
                'userMenuCategories' => MenuItem::query()->forUsers()->with('children')->get(),
            ]);
        });

        View::composer(['admin.menus.admin-checklist', 'admin.users.create', 'admin.users.edit'], function ($view) {
            $view->with([
                'adminMenuCategories' => MenuItem::query()->forAdmins()->with('children')->get(),
            ]);
        });

        View::composer('admin.roles.admin-checklist', function ($view) {
            $view->with([
                'adminRoles' => Role::where('type', UserTypeEnum::admin())->with('permissions', 'menuItems')->get(),
            ]);
        });

        View::composer('admin.roles.user-checklist', function ($view) {
            $view->with([
                'userRoles' => Role::where('type', UserTypeEnum::user())->with('permissions', 'menuItems')->get(),
            ]);
        });
    }
}
