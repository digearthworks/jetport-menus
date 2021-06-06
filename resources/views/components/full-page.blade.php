<x-app-layout>

    @isset($header)
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ $header }}
                @isset($headerActions)
                    <div class="flex items-center float-right">
                        {{ $headerActions }}
                    </div>
                @endisset
            </h2>

        </x-slot>
    @endisset

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>

</x-app-layout>
