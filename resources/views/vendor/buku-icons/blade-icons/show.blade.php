<x-buku-icons::layout :title="$icon->name">

    <div id="icon-detail" class="mt-6 relative max-w-screen-xl px-4 mx-auto sm:px-6">
        <x-buku-icons::h3>
            <x-buku-icons::a :href="$icon->set->repository">
                {{ $icon->set->name }}
            </x-buku-icon::a>

            <br class="sm:hidden"> / {{ $icon->name }}
        </x-buku-icons::h3>

        <div class="mt-6 sm:grid sm:grid-cols-5 sm:gap-10 w-full">
            <div class="sm:col-span-3 flex items-center justify-center w-full py-12 bg-gray-100 text-gray-700">
                {{ svg($icon->name, 'w-64 h-64') }}
            </div>

            <div class="mt-10 sm:mt-0 sm:col-span-2 mt-2 mr-2lg:ml-2lg:mt-0">
                <div class="w-full">
                    <x-buku-icons::h5>Install through composer</x-buku-icons::h5>
                    <x-markdown class="mt-2 font-medium prose-sm prose bg-gray-700 rounded text-gray-50 sm:text-base">```
    composer require {{ $icon->set->composer }}
    </x-markdown>
                </div>

                <div class="w-full mt-6">
                    <x-buku-icons::h5>Use it as a component</x-buku-icons::h5>
                    <x-markdown class="mt-2 font-medium prose-sm prose bg-gray-700 rounded text-gray-50 sm:text-base">```
    <x-{{ $icon->name }} />
    </x-markdown>
                </div>

                <div class="w-full mt-6">
                    <x-buku-icons::h5>Use it as a directive</x-buku-icons::h5>
                    <x-markdown class="mt-2 font-medium prose-sm prose bg-gray-700 rounded text-gray-50 sm:text-base">```
    @@svg('<?php echo $icon->name ?>')
    </x-markdown>
                </div>

                <div class="w-full mt-6">
                    <x-buku-icons::h5>Use it with a helper</x-buku-icons::h5>
                    <x-markdown class="mt-2 font-medium prose-sm prose bg-gray-700 rounded text-gray-50 sm:text-base">```
    {{ svg('<?php echo $icon->name ?>') }}
    </x-markdown>
                </div>
            </div>
        </div>

        @if (count($icons))
            <div class="mt-10">
                <x-buku-icons::h4>
                    Similar icons
                </x-buku-icons::h4>

                <div class="mt-5 grid gap-3 gap-y-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 text-sm">
                    @foreach ($icons as $icon)
                        <div
                            class="flex flex-col items-center"
                            wire:key="result_{{$icon->id}}"
                        >
                            <x-buku-icons::icon-link :icon="$icon" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <x-buku-icons::footer/>
</x-buku-icons::layout>
