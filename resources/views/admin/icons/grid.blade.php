<x-7xl>
    <x-slot name="header">
        {{__('Icons')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.icons.includes.header-actions')
    </x-slot>

    <livewire:admin.icons.includes.icon-grid />
</x-7xl>
