<x-7xl>
    <x-slot name="header">
        {{__('Roles')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.roles.header-actions')
    </x-slot>

    <livewire:admin.roles.livewire-datatable.datatable />
</x-7xl>

<livewire:admin.roles.create />
<livewire:admin.roles.edit />
<livewire:admin.roles.delete />
