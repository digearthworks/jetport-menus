<x-7xl>
    <x-slot name="header">
        {{__('Users')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.users.header-actions')
    </x-slot>

    <livewire:turbine.auth.users-table />
</x-7xl>

<livewire:turbine.auth.create-user-form />
<livewire:turbine.auth.edit-user-form />
<livewire:turbine.auth.edit-user-password-form />
<livewire:turbine.auth.clear-user-session-dialog />
<livewire:turbine.auth.delete-user-dialog />
<livewire:turbine.auth.deactivate-user-dialog />

