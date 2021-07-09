<?php

namespace Turbine\Auth\Actions;

use Illuminate\Support\Facades\Blade;

class BootComponentProviderAction
{
    public function __invoke()
    {
        Blade::component('admin.users.livewire-tables.tailwind.components.table.table', 'turbine-auth::livewire-tables.table');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.heading', 'turbine-auth::livewire-tables.table.heading');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.row', 'turbine-auth::livewire-tables.table.row');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.cell', 'turbine-auth::livewire-tables.table.cell');

        Blade::component('admin.users.livewire-tables.tailwind.components.table.table', 'turbine-auth::livewire-tables.tw.table');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.heading', 'turbine-auth::livewire-tables.tw.table.heading');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.row', 'turbine-auth::livewire-tables.tw.table.row');
        Blade::component('admin.users.livewire-tables.tailwind.components.table.cell', 'turbine-auth::livewire-tables.tw.table.cell');

        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.table', 'turbine-auth::livewire-tables.bs4.table');
        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.heading', 'turbine-auth::livewire-tables.bs4.table.heading');
        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.row', 'turbine-auth::livewire-tables.bs4.table.row');
        Blade::component('admin.users.livewire-tables.bootstrap-4.components.table.cell', 'turbine-auth::livewire-tables.bs4.table.cell');

        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.table', 'turbine-auth::livewire-tables.bs5.table');
        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.heading', 'turbine-auth::livewire-tables.bs5.table.heading');
        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.row', 'turbine-auth::livewire-tables.bs5.table.row');
        Blade::component('admin.users.livewire-tables.bootstrap-5.components.table.cell', 'turbine-auth::livewire-tables.bs5.table.cell');
    }
}
