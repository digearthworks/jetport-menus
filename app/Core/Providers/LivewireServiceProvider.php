<?php

namespace App\Core\Providers;

use App\Core\Admin\Livewire\AdminNavigationMenu;
use App\Core\Admin\Livewire\AdminSidebarMenu;
use App\Core\Admin\Livewire\AdminSidebarToggler;
use App\Core\Admin\Livewire\Icon\CreateIconButton;
use App\Core\Admin\Livewire\Icon\CreateIconForm;
use App\Core\Admin\Livewire\Icon\DeleteIconDialog;
use App\Core\Admin\Livewire\Icon\EditIconForm;
use App\Core\Admin\Livewire\Icon\IconGrid;
use App\Core\Admin\Livewire\Icon\IconSelect;
use App\Core\Admin\Livewire\Icon\IconsTable;
use App\Core\Admin\Livewire\Menu\CreateMenuButton;
use App\Core\Admin\Livewire\Menu\CreateMenuForm;
use App\Core\Admin\Livewire\Menu\DeactivateMenuDialog;
use App\Core\Admin\Livewire\Menu\DeleteMenuDialog;
use App\Core\Admin\Livewire\Menu\EditMenuForm;
use App\Core\Admin\Livewire\Menu\MenusTable;
use App\Core\Admin\Livewire\Menu\ReactivateMenuDialog;
use App\Core\Admin\Livewire\Menu\RestoreMenuDialog;
use App\Core\Admin\Livewire\Page\CreatePageButton;
use App\Core\Admin\Livewire\Page\CreatePageForm;
use App\Core\Admin\Livewire\Page\DeactivatePageDialog;
use App\Core\Admin\Livewire\Page\DeletePageDialog;
use App\Core\Admin\Livewire\Page\EditPageForm;
use App\Core\Admin\Livewire\Page\PagesTable;
use App\Core\Admin\Livewire\Page\ReactivatePageDialog;
use App\Core\Admin\Livewire\Page\RestorePageDialog;
use App\Core\Admin\Livewire\Role\CreateRoleButton;
use App\Core\Admin\Livewire\Role\CreateRoleForm;
use App\Core\Admin\Livewire\Role\DeleteRoleDialog;
use App\Core\Admin\Livewire\Role\EditRoleForm;
use App\Core\Admin\Livewire\Role\RolesTable;
use App\Core\Admin\Livewire\User\ClearUserSessionDialog;
use App\Core\Admin\Livewire\User\CreateUserButton;
use App\Core\Admin\Livewire\User\CreateUserForm;
use App\Core\Admin\Livewire\User\DeactivateUserDialog;
use App\Core\Admin\Livewire\User\DeleteUserDialog;
use App\Core\Admin\Livewire\User\EditUserForm;
use App\Core\Admin\Livewire\User\EditUserPasswordForm;
use App\Core\Admin\Livewire\User\ReactivateUserDialog;
use App\Core\Admin\Livewire\User\RestoreUserDialog;
use App\Core\Admin\Livewire\User\UsersTable;
use App\Http\Livewire\DashboardGrid;
use App\Http\Livewire\Menu\GridMenu;
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

        Livewire::component('dashboard-grid', DashboardGrid::class);
        Livewire::component('menus.grid-menu', GridMenu::class);

        Livewire::component('admin.pages.livewire-datatable.datatable', PagesTable::class);
        Livewire::component('admin.pages.create', CreatePageForm::class);
        Livewire::component('admin.pages.edit', EditPageForm::class);
        Livewire::component('admin.pages.delete', DeletePageDialog::class);
        Livewire::component('admin.pages.restore', RestorePageDialog::class);
        Livewire::component('admin.pages.deactivate', DeactivatePageDialog::class);
        Livewire::component('admin.pages.reactivate', ReactivatePageDialog::class);
        Livewire::component('admin.pages.create-page-button', CreatePageButton::class);
    }
}
