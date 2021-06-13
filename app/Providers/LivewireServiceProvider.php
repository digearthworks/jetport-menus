<?php

namespace App\Providers;

use App\Http\Livewire\Admin\AdminNavigationMenu;
use App\Http\Livewire\Admin\AdminSidebarMenu;
use App\Http\Livewire\Admin\AdminSidebarToggler;
use App\Http\Livewire\Admin\Icon\CreateIconForm;
use App\Http\Livewire\Admin\Icon\DeleteIconDialog;
use App\Http\Livewire\Admin\Icon\EditIconForm;
use App\Http\Livewire\Admin\Icon\IconGrid;
use App\Http\Livewire\Admin\Icon\IconSelect;
use App\Http\Livewire\Admin\Menu\CreateMenuButton;
use App\Http\Livewire\Admin\Menu\CreateMenuForm;
use App\Http\Livewire\Admin\Menu\DeactivateMenuDialog;
use App\Http\Livewire\Admin\Menu\DeleteMenuDialog;
use App\Http\Livewire\Admin\Menu\EditMenuForm;
use App\Http\Livewire\Admin\Menu\ReactivateMenuDialog;
use App\Http\Livewire\Admin\Menu\RestoreMenuDialog;
use App\Http\Livewire\Admin\Role\CreateRoleButton;
use App\Http\Livewire\Admin\Role\CreateRoleForm;
use App\Http\Livewire\Admin\Role\DeleteRoleDialog;
use App\Http\Livewire\Admin\Role\EditRoleForm;
use App\Http\Livewire\Admin\Site\CreateSitePageButton;
use App\Http\Livewire\Admin\Site\CreateSitePageForm;
use App\Http\Livewire\Admin\Site\DeactivateSitePageDialog;
use App\Http\Livewire\Admin\Site\DeleteSitePageDialog;
use App\Http\Livewire\Admin\Site\EditSitePageForm;
use App\Http\Livewire\Admin\Site\ReactivateSitePageDialog;
use App\Http\Livewire\Admin\Site\RestoreSitePageDialog;
use App\Http\Livewire\Admin\User\ClearUserSessionDialog;
use App\Http\Livewire\Admin\User\CreateUserButton;
use App\Http\Livewire\Admin\User\CreateUserForm;
use App\Http\Livewire\Admin\User\DeactivateUserDialog;
use App\Http\Livewire\Admin\User\DeleteUserDialog;
use App\Http\Livewire\Admin\User\EditUserForm;
use App\Http\Livewire\Admin\User\EditUserPasswordForm;
use App\Http\Livewire\Admin\User\ReactivateUserDialog;
use App\Http\Livewire\Admin\User\RestoreUserDialog;
use App\Http\Livewire\Admin\User\UsersTable;
use App\Http\Livewire\DashboardGrid;
use App\Http\Livewire\Menu\MenuGrid;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('admin.navigation-menu', AdminNavigationMenu::class);
        Livewire::component('admin.sidebar-menu', AdminSidebarMenu::class);
        Livewire::component('admin.includes.sidebar-toggler', AdminSidebarToggler::class);

        Livewire::component('admin.users.livewire-datatable.datatable', UsersTable::class);
        Livewire::component('admin.users.includes.partials.create-user-button', CreateUserButton::class);
        Livewire::component('admin.users.create', CreateUserForm::class);
        Livewire::component('admin.users.edit', EditUserForm::class);
        Livewire::component('admin.users.delete', DeleteUserDialog::class);
        Livewire::component('admin.users.restore', RestoreUserDialog::class);
        Livewire::component('admin.users.deactivate', DeactivateUserDialog::class);
        Livewire::component('admin.users.change-password', EditUserPasswordForm::class);
        Livewire::component('admin.users.clear-sessions', ClearUserSessionDialog::class);
        Livewire::component('admin.users.reactivate', ReactivateUserDialog::class);

        Livewire::component('admin.roles.create', CreateRoleForm::class);
        Livewire::component('admin.roles.edit', EditRoleForm::class);
        Livewire::component('admin.roles.delete', DeleteRoleDialog::class);
        Livewire::component('admin.roles.includes.partials.create-role-button', CreateRoleButton::class);

        Livewire::component('admin.menus.create', CreateMenuForm::class);
        Livewire::component('admin.menus.edit', EditMenuForm::class);
        Livewire::component('admin.menus.delete', DeleteMenuDialog::class);
        Livewire::component('admin.menus.deactivate', DeactivateMenuDialog::class);
        Livewire::component('admin.menus.reactivate', ReactivateMenuDialog::class);
        Livewire::component('admin.menus.restore', RestoreMenuDialog::class);
        Livewire::component('admin.menus.includes.partials.create-menu-button', CreateMenuButton::class);

        Livewire::component('admin.icons.icon-select', IconSelect::class);
        Livewire::component('admin.icons.create', CreateIconForm::class);
        Livewire::component('admin.icons.edit', EditIconForm::class);
        Livewire::component('admin.icons.delete', DeleteIconDialog::class);
        Livewire::component('admin.icons.includes.icon-grid', IconGrid::class);

        Livewire::component('includes.dashboard-grid', DashboardGrid::class);
        Livewire::component('menu.includes.menu-grid', MenuGrid::class);

        Livewire::component('admin.site.pages.create', CreateSitePageForm::class);
        Livewire::component('admin.site.pages.edit', EditSitePageForm::class);
        Livewire::component('admin.site.pages.delete', DeleteSitePageDialog::class);
        Livewire::component('admin.site.pages.restore', RestoreSitePageDialog::class);
        Livewire::component('admin.site.pages.deactivate', DeactivateSitePageDialog::class);
        Livewire::component('admin.site.pages.reactivate', ReactivateSitePageDialog::class);
        Livewire::component('admin.site.pages.includes.partials.create-site-page-button', CreateSitePageButton::class);
    }
}
