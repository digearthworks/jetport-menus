<x-app-layout>

    @isset($header)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @lang($header)
            </h2>
        </x-slot>
    @endisset

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>

</x-app-layout>
