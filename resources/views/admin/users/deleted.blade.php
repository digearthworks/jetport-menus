<x-7xl>
    <x-slot name="header">
        {{__('Deleted Users')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.users.header-actions')
    </x-slot>

    <livewire:turbine.auth.users-table status="deleted" />
</x-7xl>

<livewire:turbine.auth.restore-user-dialog />
