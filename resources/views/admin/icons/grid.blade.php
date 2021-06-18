<x-7xl>
    <x-slot name="header">
        {{__('Icons')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.icons.header-actions')
    </x-slot>

    <livewire:admin.icons.icon-grid />
</x-7xl>
<livewire:admin.icons.create />
