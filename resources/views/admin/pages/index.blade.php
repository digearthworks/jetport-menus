<x-7xl>
    <x-slot name="header">
        {{__('Pages')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.pages.header-actions')
    </x-slot>

    @include('admin.pages.table')

    <livewire:admin.pages.create />
    <livewire:admin.pages.edit />
    <livewire:admin.pages.delete />
    <livewire:admin.pages.deactivate />
</x-7xl>


