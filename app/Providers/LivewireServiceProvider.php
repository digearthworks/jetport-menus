<?php

namespace App\Providers;

use App\Http\Livewire\AdminNavigationMenu;
use App\Http\Livewire\AdminSidebar;
use App\Http\Livewire\AdminSidebarToggler;
use App\Http\Livewire\ClearUserSession;
use App\Http\Livewire\CreateButton;
use App\Http\Livewire\CreateMenu;
use App\Http\Livewire\CreateRole;
use App\Http\Livewire\CreateRoleButton;
use App\Http\Livewire\CreateUser;
use App\Http\Livewire\CreateUserButton;
use App\Http\Livewire\DeactivateUser;
use App\Http\Livewire\DeleteRole;
use App\Http\Livewire\DeleteUser;
use App\Http\Livewire\EditMenu;
use App\Http\Livewire\EditRole;
use App\Http\Livewire\EditUser;
use App\Http\Livewire\EditUserPassword;
use App\Http\Livewire\ReactivateUser;
use App\Http\Livewire\RestoreUser;
use App\Http\Livewire\UsersTable;
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
        Livewire::component('admin.users.create', CreateUser::class);
        Livewire::component('admin.users.edit', EditUser::class);
        Livewire::component('admin.users.delete', DeleteUser::class);
        Livewire::component('admin.users.restore', RestoreUser::class);
        Livewire::component('admin.users.deactivate', DeactivateUser::class);
        Livewire::component('admin.users.change-password', EditUserPassword::class);
        Livewire::component('admin.users.clear-sessions', ClearUserSession::class);
        Livewire::component('admin.users.reactivate', ReactivateUser::class);

        Livewire::component('admin.roles.create', CreateRole::class);
        Livewire::component('admin.roles.edit', EditRole::class);
        Livewire::component('admin.roles.delete', DeleteRole::class);
        Livewire::component('admin.users.includes.partials.create-user-button', CreateRoleButton::class);

        Livewire::component('admin.includes.partials.create-button', CreateButton::class);

        Livewire::component('admin.menus.create', CreateMenu::class);
        Livewire::component('admin.menus.edit', EditMenu::class);
    }
}
