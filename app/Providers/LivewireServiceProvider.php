<?php

namespace App\Providers;

use App\Admin\Livewire\AdminNavigationMenu;
use App\Admin\Livewire\AdminSidebarMenu;
use App\Admin\Livewire\AdminSidebarToggler;
use App\Admin\Livewire\Icon\CreateIconButton;
use App\Admin\Livewire\Icon\CreateIconForm;
use App\Admin\Livewire\Icon\DeleteIconDialog;
use App\Admin\Livewire\Icon\EditIconForm;
use App\Admin\Livewire\Icon\IconGrid;
use App\Admin\Livewire\Icon\IconSelect;
use App\Admin\Livewire\Icon\IconsTable;
use App\Admin\Livewire\Menu\CreateMenuButton;
use App\Admin\Livewire\Menu\CreateMenuForm;
use App\Admin\Livewire\Menu\DeactivateMenuDialog;
use App\Admin\Livewire\Menu\DeleteMenuDialog;
use App\Admin\Livewire\Menu\EditMenuForm;
use App\Admin\Livewire\Menu\MenusTable;
use App\Admin\Livewire\Menu\ReactivateMenuDialog;
use App\Admin\Livewire\Menu\RestoreMenuDialog;
use App\Admin\Livewire\Role\CreateRoleButton;
use App\Admin\Livewire\Role\CreateRoleForm;
use App\Admin\Livewire\Role\DeleteRoleDialog;
use App\Admin\Livewire\Role\EditRoleForm;
use App\Admin\Livewire\Role\RolesTable;
use App\Admin\Livewire\Site\CreateSitePageButton;
use App\Admin\Livewire\Site\CreateSitePageForm;
use App\Admin\Livewire\Site\DeactivateSitePageDialog;
use App\Admin\Livewire\Site\DeleteSitePageDialog;
use App\Admin\Livewire\Site\EditSitePageForm;
use App\Admin\Livewire\Site\ReactivateSitePageDialog;
use App\Admin\Livewire\Site\RestoreSitePageDialog;
use App\Admin\Livewire\Site\SitePagesTable;
use App\Admin\Livewire\User\ClearUserSessionDialog;
use App\Admin\Livewire\User\CreateUserButton;
use App\Admin\Livewire\User\CreateUserForm;
use App\Admin\Livewire\User\DeactivateUserDialog;
use App\Admin\Livewire\User\DeleteUserDialog;
use App\Admin\Livewire\User\EditUserForm;
use App\Admin\Livewire\User\EditUserPasswordForm;
use App\Admin\Livewire\User\ReactivateUserDialog;
use App\Admin\Livewire\User\RestoreUserDialog;
use App\Admin\Livewire\User\UsersTable;
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
        Livewire::component('admin.sidebar-toggler', AdminSidebarToggler::class);

        Livewire::component('admin.users.livewire-datatable.datatable', UsersTable::class);
        Livewire::component('admin.users.create-user-button', CreateUserButton::class);
        Livewire::component('admin.users.create', CreateUserForm::class);
        Livewire::component('admin.users.edit', EditUserForm::class);
        Livewire::component('admin.users.delete', DeleteUserDialog::class);
        Livewire::component('admin.users.restore', RestoreUserDialog::class);
        Livewire::component('admin.users.deactivate', DeactivateUserDialog::class);
        Livewire::component('admin.users.change-password', EditUserPasswordForm::class);
        Livewire::component('admin.users.clear-sessions', ClearUserSessionDialog::class);
        Livewire::component('admin.users.reactivate', ReactivateUserDialog::class);

        Livewire::component('admin.roles.livewire-datatable.datatable', RolesTable::class);
        Livewire::component('admin.roles.create', CreateRoleForm::class);
        Livewire::component('admin.roles.edit', EditRoleForm::class);
        Livewire::component('admin.roles.delete', DeleteRoleDialog::class);
        Livewire::component('admin.roles.create-role-button', CreateRoleButton::class);

        Livewire::component('admin.menus.livewire-datatable.datatable', MenusTable::class);
        Livewire::component('admin.menus.create', CreateMenuForm::class);
        Livewire::component('admin.menus.edit', EditMenuForm::class);
        Livewire::component('admin.menus.delete', DeleteMenuDialog::class);
        Livewire::component('admin.menus.deactivate', DeactivateMenuDialog::class);
        Livewire::component('admin.menus.reactivate', ReactivateMenuDialog::class);
        Livewire::component('admin.menus.restore', RestoreMenuDialog::class);
        Livewire::component('admin.menus.create-menu-button', CreateMenuButton::class);

        Livewire::component('admin.icons.livewire-datatable.datatable', IconsTable::class);
        Livewire::component('admin.icons.icon-select', IconSelect::class);
        Livewire::component('admin.icons.create', CreateIconForm::class);
        Livewire::component('admin.icons.create-icon-button', CreateIconButton::class);
        Livewire::component('admin.icons.edit', EditIconForm::class);
        Livewire::component('admin.icons.delete', DeleteIconDialog::class);
        Livewire::component('admin.icons.icon-grid', IconGrid::class);

        Livewire::component('includes.dashboard-grid', DashboardGrid::class);
        Livewire::component('menu.includes.menu-grid', MenuGrid::class);

        Livewire::component('admin.site.pages.livewire-datatable.datatable', SitePagesTable::class);
        Livewire::component('admin.site.pages.create', CreateSitePageForm::class);
        Livewire::component('admin.site.pages.edit', EditSitePageForm::class);
        Livewire::component('admin.site.pages.delete', DeleteSitePageDialog::class);
        Livewire::component('admin.site.pages.restore', RestoreSitePageDialog::class);
        Livewire::component('admin.site.pages.deactivate', DeactivateSitePageDialog::class);
        Livewire::component('admin.site.pages.reactivate', ReactivateSitePageDialog::class);
        Livewire::component('admin.pages.create-page-button', CreateSitePageButton::class);
    }
}
