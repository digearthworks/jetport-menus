<x-7xl>
    <x-slot name="header">
        {{__('Deactivated Users')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.users.header-actions')
    </x-slot>

    <livewire:turbine.auth.users-table status="deactivated" />
</x-7xl>

<livewire:turbine.auth.reactivate-user-dialog />
<livewire:turbine.auth.delete-user-dialog />
<livewire:turbine.auth.edit-user-form />
