<?php

namespace App\Core\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('admin.users.livewire-tables.tailwind.components.table.table', 'admin.users.livewire-tables.table');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.heading', 'admin.users.livewire-tables.table.heading');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.row', 'admin.users.livewire-tables.table.row');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.cell', 'admin.users.livewire-tables.table.cell');

        Blade::component('admin.users.livewire-tables.tailwind.components.table.table', 'admin.users.livewire-tables.tw.table');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.heading', 'admin.users.livewire-tables.tw.table.heading');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.row', 'admin.users.livewire-tables.tw.table.row');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.cell', 'admin.users.livewire-tables.tw.table.cell');

        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.table', 'admin.users.livewire-tables.bs4.table');
        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.heading', 'admin.users.livewire-tables.bs4.table.heading');
        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.row', 'admin.users.livewire-tables.bs4.table.row');
        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.cell', 'admin.users.livewire-tables.bs4.table.cell');

        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.table', 'admin.users.livewire-tables.bs5.table');
        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.heading', 'admin.users.livewire-tables.bs5.table.heading');
        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.row', 'admin.users.livewire-tables.bs5.table.row');
        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.cell', 'admin.users.livewire-tables.bs5.table.cell');
    }
}
