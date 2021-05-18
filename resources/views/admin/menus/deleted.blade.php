<x-7xl>
    <x-slot name="header">
        {{__('Menus')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.menus.includes.header-actions')
    </x-slot>

    @include('admin.menus.includes.table', ['status' => 'deleted'])
</x-7xl>

<livewire:admin.menus.restore />
