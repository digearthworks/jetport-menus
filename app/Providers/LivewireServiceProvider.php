<?php

namespace App\Providers;

use App\Actions\Jetstream\DeletesUser;
use App\Http\Livewire\EditsUser;
use App\Http\Livewire\Sidebar;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('sidebar', Sidebar::class);
        Livewire::component('admin.user.edit', EditsUser::class);
        Livewire::component('admin.user.delete', DeletesUser::class);
        Livewire::component('admin.user.restore', RestoresUser::class);
        Livewire::component('admin.user.deactivate', DeactivatesUser::class);
        // Livewire::component('admin.user.reactivate', ReactivatesUser::class);
    }
}
