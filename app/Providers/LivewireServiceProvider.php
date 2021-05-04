<?php

namespace App\Providers;

use App\Http\Livewire\EditUser;
use App\Http\Livewire\Sidebar;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function register()
    {
        Livewire::component('sidebar', Sidebar::class);
        Livewire::component('admin.user.edit', EditUser::class);
    }

    public function boot()
    {
        //
    }
}
