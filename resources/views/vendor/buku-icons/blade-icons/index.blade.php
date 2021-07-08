<x-buku-icons::layout title="Blade Icons">
    <div>
        <div class="mt-16 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <x-buku-icons::h3>
                    Search for an icon
                </x-buku-icons::h3>
                <x-buku-icons::p>
                    With {{ HeaderX\BukuIcons\Models\IconSet::count() }} different icon sets, we probably can find the right one for you.
                </x-buku-icons::p>
            </div>
        </div>

        <div id="search" class="relative flex items-center justify-between max-w-screen-2xl px-4 mt-6 p-8 sm:mt-0 mx-auto sm:px-6">
            <livewire:buku-icons::icon-search/>
        </div>
    </div>
    <x-buku-icons::footer/>
</x-buku-icons::layout>
