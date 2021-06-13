<x-7xl>
    <x-slot name="header">
        {{__('Pages')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.site.includes.header-actions')
    </x-slot>

    @include('admin.site.pages.includes.table')

    <livewire:admin.site.pages.create />
    <livewire:admin.site.pages.edit />
    <livewire:admin.site.pages.delete />
    <livewire:admin.site.pages.deactivate />
</x-7xl>


