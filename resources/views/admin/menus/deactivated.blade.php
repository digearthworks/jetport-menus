<x-7xl>
    <x-slot name="header">
        {{__('Menus')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.menus.includes.header-actions')
    </x-slot>

    <livewire:menus-table status="deactivated" />
</x-7xl>
<livewire:admin.menus.reactivate />
