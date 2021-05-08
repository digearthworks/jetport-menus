<?php

namespace App\Providers;

use App\Actions\Jetstream\DeletesUser;
use App\Http\Livewire\ClearsSessions;
use App\Http\Livewire\CreatesUser;
use App\Http\Livewire\CreateUserButton;
use App\Http\Livewire\DeactivatesUser;
use App\Http\Livewire\EditsUser;
use App\Http\Livewire\EditsUserPassword;
use App\Http\Livewire\ReactivatesUser;
use App\Http\Livewire\Sidebar;
use App\Http\Livewire\UsersTable;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('sidebar', Sidebar::class);

        Livewire::component('admin.users.livewire-datatable.datatable', UsersTable::class);
        Livewire::component('admin.users.includes.partials.create-user-button', CreateUserButton::class);
        Livewire::component('admin.users.create', CreatesUser::class);
        Livewire::component('admin.users.edit', EditsUser::class);
        Livewire::component('admin.users.delete', DeletesUser::class);
        Livewire::component('admin.users.restore', RestoresUser::class);
        Livewire::component('admin.users.deactivate', DeactivatesUser::class);
        Livewire::component('admin.users.change-password', EditsUserPassword::class);
        Livewire::component('admin.users.clears-sessions', ClearsSessions::class);
        Livewire::component('admin.users.reactivate', ReactivatesUser::class);
    }
}
