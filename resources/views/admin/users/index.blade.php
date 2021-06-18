<x-7xl>
    <x-slot name="header">
        {{__('Users')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.users.header-actions')
    </x-slot>

    <livewire:admin.users.livewire-datatable.datatable />
</x-7xl>

<livewire:admin.users.create />
<livewire:admin.users.edit />
<livewire:admin.users.change-password />
<livewire:admin.users.clear-sessions />
<livewire:admin.users.delete />
<livewire:admin.users.deactivate />

