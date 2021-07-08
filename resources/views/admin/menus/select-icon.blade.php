{{-- {{ dd($icons) }} --}}
<div class="w-full">
    <div class="relative flex items-center w-full mb-6">
        <div class="flex flex-col items-center w-full border border-gray-200 rounded-lg shadow-md md:flex-row">
            <div class="relative flex-shrink block inline-block w-full h-full pr-2 border-b md:w-auto md:border-b-0 md:border-r">
                <select
                    wire:model="set"
                    class="block w-full h-full p-2 mr-2 text-xl bg-transparent appearance-none focus:outline-none"
                >
                    <option value="">All icons</option>

                    @foreach ($sets as $set)
                        <option wire:key="set_{{ $set->id }}" value="{{ $set->id }}">
                            {{ $set->name() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="relative w-full">
                <input
                    class="block w-full p-2 border-0 rounded-lg text-md"
                    autocapitalize="off"
                    autocomplete="off"
                    autocorrect="off"
                    spellcheck="false"
                    type="text"
                    placeholder="Search all {{ number_format($total) }} Blade icons ..."
                    wire:model.debounce.400ms="search"
                >
                <div class="absolute inset-y-0 right-0 flex items-center justify-center mr-5">
                    <div wire:loading>
                        <x-heroicon-o-refresh class="inline w-6 h-6 text-indigo-500 fill-current animate-spin"/>
                    </div>

                    <div wire:loading.remove>
                        <button wire:click="resetSearch">
                            @if ($search)
                                <x-antdesign-close-o class="inline w-6 h-6 text-gray-500 transition duration-300 ease-in-out fill-current hover:text-scarlet-500"/>
                            @else
                                <x-heroicon-o-refresh class="inline w-6 h-6 transition duration-300 ease-in-out fill-current text-scarlet-600 hover:text-scarlet-500"/>
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        @if ($search)
            <x-buku-icons::p>
                <span class="text-gray-500">Found:</span> {{ trans_choice('app.icons-result', count($icons)) }}
            </x-buku-icons::p>
        @endif
        <x-form-help-text value="Please select an Icon from below" />

        <div class="grid grid-cols-2 gap-1 mt-2 text-sm gap-y-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-10">
            @foreach ($icons as $icon)
                <div
                    wire:click="$emit('selectIcon', '{{ $icon->id }}')"
                    wire:key="result_{{ $icon->id }}"
                    class="flex flex-col items-center"
                >
                <a
                    {{-- href="{{ route('blade-icon', $icon) }}" --}}
                    class="flex flex-col items-center justify-between w-full h-full p-3 text-gray-500 transition duration-300 ease-in-out border border-gray-200 rounded-md hover:text-indigo-500 hover:shadow-md"
                    title="{{ $icon->name }}"
                >
                    {{ svg($icon->name, 'w-8 h-8') }}
            
                <span class="max-w-full mt-3 text-center truncate">
                    {{ $icon->name }}
                </span>
            </a>
            
                </div>
            @endforeach
        </div>
    </div>
</div>
