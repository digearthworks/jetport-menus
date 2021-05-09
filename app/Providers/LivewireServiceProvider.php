<?php

namespace App\Providers;

use App\Http\Livewire\ClearSession;
use App\Http\Livewire\CreateUser;
use App\Http\Livewire\CreateUserButton;
use App\Http\Livewire\DeactivateUser;
use App\Http\Livewire\DeleteUser;
use App\Http\Livewire\EditUser;
use App\Http\Livewire\EditUserPassword;
use App\Http\Livewire\ReactivateUser;
use App\Http\Livewire\RestoreUser;
use App\Http\Livewire\Sidebar;
use App\Http\Livewire\SidebarToggler;
use App\Http\Livewire\UsersTable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('sidebar', Sidebar::class);
        Livewire::component('includes.sidebar-toggler', SidebarToggler::class);

        Livewire::component('admin.users.livewire-datatable.datatable', UsersTable::class);
        Livewire::component('admin.users.includes.partials.create-user-button', CreateUserButton::class);
        Livewire::component('admin.users.create', CreateUser::class);
        Livewire::component('admin.users.edit', EditUser::class);
        Livewire::component('admin.users.delete', DeleteUser::class);
        Livewire::component('admin.users.restore', RestoreUser::class);
        Livewire::component('admin.users.deactivate', DeactivateUser::class);
        Livewire::component('admin.users.change-password', EditUserPassword::class);
        Livewire::component('admin.users.clear-sessions', ClearSession::class);
        Livewire::component('admin.users.reactivate', ReactivateUser::class);
    }
}
