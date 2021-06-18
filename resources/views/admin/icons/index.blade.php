<x-7xl>
    <x-slot name="header">
        {{__('Icons')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.icons.header-actions')
    </x-slot>

    <livewire:admin.icons.livewire-datatable.datatable />
</x-7xl>

<livewire:admin.icons.create />
<livewire:admin.icons.edit />
<livewire:admin.icons.delete />
