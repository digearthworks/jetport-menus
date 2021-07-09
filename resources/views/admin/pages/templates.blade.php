<x-7xl>
    <x-slot name="header">
        {{__('Pages')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.pages.header-actions')
    </x-slot>

    <livewire:turbine.pages.page-templates-table />

    {{-- <livewire:turbine.pages.create-page-form /> --}}
    {{-- <livewire:turbine.pages.edit-page-form /> --}}
    <livewire:turbine.pages.delete-page-template-dialog />
</x-7xl>


