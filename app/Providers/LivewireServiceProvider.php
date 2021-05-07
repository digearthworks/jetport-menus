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
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('sidebar', Sidebar::class);
        Livewire::component('admin.user.edit', EditsUser::class);
        Livewire::component('admin.user.includes.partials.create-user-button', CreateUserButton::class);
        Livewire::component('admin.user.create', CreatesUser::class);
        Livewire::component('admin.user.delete', DeletesUser::class);
        Livewire::component('admin.user.restore', RestoresUser::class);
        Livewire::component('admin.user.deactivate', DeactivatesUser::class);
        Livewire::component('admin.user.change-password', EditsUserPassword::class);
        Livewire::component('admin.user.clears-sessions', ClearsSessions::class);
        Livewire::component('admin.user.reactivate', ReactivatesUser::class);
    }
}
