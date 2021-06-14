<x-livewire-tables::tw.table.cell>
    @if ($row->type === \App\Auth\Models\User::TYPE_ADMIN)
        {{ __('Administrator') }}
    @elseif ($row->type === \App\Auth\Models\User::TYPE_USER)
        {{ __('User') }}
    @else
        N/A
    @endif
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->name }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {!! $row->permissions_label !!}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->users_count }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {!! $row->all_menus_label !!}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    @include('admin.roles.includes.actions', ['model' => $row])
</x-livewire-tables::tw.table.cell>
