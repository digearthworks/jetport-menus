<x-app-layout>
    <x-slot name="header">

        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{__('Pages')}}

            <div class="flex items-center float-right">
                @include('admin.pages.header-actions')
            </div>
        </h2>

    </x-slot>

    <livewire:turbine.pages.create-page-template-form />
</x-app-layout>




