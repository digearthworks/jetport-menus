<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                @php $columns='label,group,active,icon.title,link,created_at,updated_at' @endphp
                <livewire:datatable
                    model="App\Models\Menu"
                    :include="$columns"
                    searchable="parent.label,group,active,icon.title,link"
                    dates="created_at,updated_at"
                    exportable
                />
            </div>
        </div>
    </div>
</x-app-layout>
