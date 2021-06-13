<x-7xl>
    <x-slot name="header">
        {{__('Icons')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.icons.includes.header-actions')
    </x-slot>

    <livewire:admin.icon.icons-table />
</x-7xl>

<livewire:admin.icons.create />
<livewire:admin.icons.edit />
<livewire:admin.icons.delete />
