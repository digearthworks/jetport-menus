<x-7xl>
    <x-slot name="header">
        {{__('Menus')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.menus.includes.header-actions')
    </x-slot>

    <livewire:menus-table />
</x-7xl>
<livewire:admin.menus.create />
<livewire:admin.menus.edit />
<livewire:admin.menus.delete />
