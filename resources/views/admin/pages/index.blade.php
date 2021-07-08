<x-7xl>
    <x-slot name="header">
        {{__('Pages')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.pages.header-actions')
    </x-slot>

    @include('admin.pages.table')

    {{-- <livewire:turbine.pages.create-page-form /> --}}
    {{-- <livewire:turbine.pages.edit-page-form /> --}}
    <livewire:turbine.pages.delete-page-dialog />
    <livewire:turbine.pages.deactivate-page-dialog />
</x-7xl>


