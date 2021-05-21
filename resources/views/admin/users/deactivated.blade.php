<x-7xl>
    <x-slot name="header">
        {{__('Deactivated Users')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.users.includes.header-actions')
    </x-slot>

    <livewire:admin.users.livewire-datatable.datatable status="deactivated" />
</x-7xl>

<livewire:admin.users.reactivate />
<livewire:admin.users.delete />
<livewire:admin.users.edit />
