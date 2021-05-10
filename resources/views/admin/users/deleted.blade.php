<x-7xl>
    <x-slot name="header">
        {{__('Deleted Users')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.users.includes.header-actions')
    </x-slot>

    <livewire:users-table status="deleted" />
</x-7xl>

<livewire:admin.users.restore />
