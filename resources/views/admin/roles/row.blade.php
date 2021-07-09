<x-livewire-tables::tw.table.cell>
    @if ($row->type === \Turbine\Auth\Enums\UserTypeEnum::admin())
        {{ __('Administrator') }}
    @elseif ($row->type === \Turbine\Auth\Enums\UserTypeEnum::user())
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
    @include('admin.roles.actions', ['model' => $row])
</x-livewire-tables::tw.table.cell>
