<x-turbine-auth::livewire-tables.tw.table.cell>
    @include('admin.users.type', ['user' => $row])
</x-turbine-auth::livewire-tables.tw.table.cell>

<x-turbine-auth::livewire-tables.tw.table.cell>
    {{ $row->name }}
</x-turbine-auth::livewire-tables.tw.table.cell>

<x-turbine-auth::livewire-tables.tw.table.cell>
    <a href="mailto:{{ $row->email }}">{{ $row->email }}</a>
</x-turbine-auth::livewire-tables.tw.table.cell>

{{-- <x-turbine-auth::livewire-tables.tw.table.cell>
    @include('admin.users.verified', ['user' => $row])
</x-turbine-auth::livewire-tables.tw.table.cell> --}}

<x-turbine-auth::livewire-tables.tw.table.cell>
    {{ $row->last_login_at ? $row->last_login_at->diffForHumans() : __('Never') }}
</x-turbine-auth::livewire-tables.tw.table.cell>

<x-turbine-auth::livewire-tables.tw.table.cell>
    {!! $row->roles_label !!}
</x-turbine-auth::livewire-tables.tw.table.cell>

{{-- <x-turbine-auth::livewire-tables.tw.table.cell>
    {!! $row->permissions_label !!}
</x-turbine-auth::livewire-tables.tw.table.cell> --}}

<x-turbine-auth::livewire-tables.tw.table.cell>
   {!! $row->getAllMenuItemsLabel() !!}
</x-turbine-auth::livewire-tables.tw.table.cell>

<x-turbine-auth::livewire-tables.tw.table.cell>
    @include('admin.users.actions', ['user' => $row])
</x-turbine-auth::livewire-tables.tw.table.cell>
