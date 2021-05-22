<x-admin.users.livewire-tables.tw.table.cell>
    @include('admin.users.includes.type', ['user' => $row])
</x-admin.users.livewire-tables.tw.table.cell>

<x-admin.users.livewire-tables.tw.table.cell>
    {{ $row->name }}
</x-admin.users.livewire-tables.tw.table.cell>

<x-admin.users.livewire-tables.tw.table.cell>
    <a href="mailto:{{ $row->email }}">{{ $row->email }}</a>
</x-admin.users.livewire-tables.tw.table.cell>

<x-admin.users.livewire-tables.tw.table.cell>
    @include('admin.users.includes.verified', ['user' => $row])
</x-admin.users.livewire-tables.tw.table.cell>

<x-admin.users.livewire-tables.tw.table.cell>
    {{ $row->last_login_at ? $row->last_login_at->diffForHumans() : __('Never') }}
</x-admin.users.livewire-tables.tw.table.cell>

<x-admin.users.livewire-tables.tw.table.cell>
    {!! $row->roles_label !!}
</x-admin.users.livewire-tables.tw.table.cell>

{{-- <x-admin.users.livewire-tables.tw.table.cell>
    {!! $row->permissions_label !!}
</x-admin.users.livewire-tables.tw.table.cell> --}}

<x-admin.users.livewire-tables.tw.table.cell>
   {!! $row->getAllMenusLabel() !!}
</x-admin.users.livewire-tables.tw.table.cell>

<x-admin.users.livewire-tables.tw.table.cell>
    @include('admin.users.includes.actions', ['user' => $row])
</x-admin.users.livewire-tables.tw.table.cell>
