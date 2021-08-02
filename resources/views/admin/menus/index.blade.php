<x-7xl>
    <x-slot name="header">
        {{__('Menus')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.menus.header-actions')
    </x-slot>

    @include('admin.menus.table')
    <livewire:turbine.menus.admin.create-menu-item-form wire:key="create-{{ now()->format('ymdHis') }}" />
    <livewire:turbine.menus.admin.edit-menu-item-form wire:key="edit-{{ now()->format('ymdHis') }}" />
    <livewire:turbine.menus.admin.delete-menu-item-dialog />
    <livewire:turbine.menus.admin.deactivate-menu-item-dialog />
</x-7xl>

