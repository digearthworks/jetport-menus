@if (isset($bulkActions) && count($bulkActions))
    <div class="w-full mb-4 md:w-auto md:mb-0">
        <div
            x-data="{ open: false }"
            @keydown.window.escape="open = false"
            @click.away="open = false"
            class="relative z-10 inline-block w-full text-left md:w-auto"
        >
            <div>
                <span class="rounded-md shadow-sm">
                    <button
                        @click="open = !open"
                        type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-indigo-300 focus:shadow-outline-indigo active:bg-gray-50 active:text-gray-800"
                        id="options-menu"
                        aria-haspopup="true"
                        x-bind:aria-expanded="open"
                        aria-expanded="true"
                    >
                        @lang('Bulk Actions')

                        <svg class="w-5 h-5 ml-2 -mr-1" x-description="Heroicon name: chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </span>
            </div>

            <div
                x-cloak
                x-cloak x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-50 w-48 mt-2 origin-top-right rounded-md shadow-lg"
            >
                <div class="bg-white rounded-md shadow-xs">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        @foreach($bulkActions as $action => $title)
                            <button
                                wire:click="{{ $action }}"
                                wire:key="bulk-action-{{ $action }}"
                                type="button"
                                class="flex items-center block w-full px-4 py-2 space-x-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900"
                                role="menuitem"
                            >
                                <span>{{ $title }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
