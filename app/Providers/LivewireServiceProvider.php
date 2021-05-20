<?php

namespace App\Providers;

use App\Http\Livewire\Admin\User\ClearUserSessionDialog;
use App\Http\Livewire\Admin\User\CreateUserForm;
use App\Http\Livewire\Admin\User\CreateUserButton;
use App\Http\Livewire\Admin\User\DeactivateUserDialog;
use App\Http\Livewire\Admin\User\DeleteUserDialog;
use App\Http\Livewire\Admin\User\EditUserForm;
use App\Http\Livewire\Admin\User\EditUserPasswordForm;
use App\Http\Livewire\Admin\User\ReactivateUserDialog;
use App\Http\Livewire\Admin\User\RestoreUserDialog;
use App\Http\Livewire\Admin\User\UsersTable;
use App\Http\Livewire\AdminNavigationMenu;
use App\Http\Livewire\AdminSidebar;
use App\Http\Livewire\AdminSidebarToggler;
use App\Http\Livewire\CreateButton;
use App\Http\Livewire\CreateMenu;
use App\Http\Livewire\CreateRole;
use App\Http\Livewire\CreateRoleButton;
use App\Http\Livewire\DeactivateMenu;
use App\Http\Livewire\DeleteMenu;
use App\Http\Livewire\DeleteRole;
use App\Http\Livewire\EditMenu;
use App\Http\Livewire\EditRole;
use App\Http\Livewire\ReactivateMenu;
use App\Http\Livewire\RestoreMenu;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('admin.navigation-menu', AdminNavigationMenu::class);
        Livewire::component('admin.sidebar', AdminSidebar::class);
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

        Livewire::component('admin.roles.create', CreateRole::class);
        Livewire::component('admin.roles.edit', EditRole::class);
        Livewire::component('admin.roles.delete', DeleteRole::class);
        Livewire::component('admin.roles.includes.partials.create-role-button', CreateRoleButton::class);

        Livewire::component('admin.includes.partials.create-button', CreateButton::class);

        Livewire::component('admin.menus.create', CreateMenu::class);
        Livewire::component('admin.menus.edit', EditMenu::class);
        Livewire::component('admin.menus.delete', DeleteMenu::class);
        Livewire::component('admin.menus.deactivate', DeactivateMenu::class);
        Livewire::component('admin.menus.reactivate', ReactivateMenu::class);
        Livewire::component('admin.menus.restore', RestoreMenu::class);
    }
}
