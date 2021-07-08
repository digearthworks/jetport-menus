<x-7xl>
    <x-slot name="header">
        {{__('Roles')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.roles.header-actions')
    </x-slot>

    <livewire:turbine.auth.roles-table />
    
    <livewire:turbine.auth.create-role-form />
    <livewire:turbine.auth.edit-role-form />
    <livewire:turbine.auth.delete-role-dialog />
    
</x-7xl>