<x-7xl>
    <x-slot name="header">
        {{__('Pages')}}
    </x-slot>

    <x-slot name="headerActions">
        @include('admin.pages.header-actions')
    </x-slot>

    @include('admin.pages.table', [ 'status' => 'deleted' ])

    <livewire:turbine.pages.restore-page-dialog />
</x-7xl>


