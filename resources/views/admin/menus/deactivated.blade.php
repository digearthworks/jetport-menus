<x-7xl>
    <x-slot name="header">
        {{__('Menus')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.menus.header-actions')
    </x-slot>

    @include('admin.menus.table', ['status' => 'deactivated'])
</x-7xl>
<livewire:turbine.menus.admin.reactivate-menu-item-dialog />
