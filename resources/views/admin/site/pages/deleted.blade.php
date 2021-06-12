<x-7xl>
    <x-slot name="header">
        {{__('Pages')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.site.includes.header-actions')
    </x-slot>

    @include('admin.site.pages.includes.table', [ 'status' => 'deleted' ])

    <livewire:admin.site.pages.restore />
</x-7xl>


