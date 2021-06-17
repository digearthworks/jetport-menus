<div>
    <input wire:model.debounce.50ms="query" placeholder="Search Icons" class="w-full p-1 px-2 text-gray-800 outline-none appearance-none">
    <x-compact-grid>
        @forelse($icons as $item)
            <x-compact-article-stacked wire:click="$set('query', '{{ $item['input'] }}')" x-data="{ tooltip: false }" x-on:click="$clipboard('{{ trim($item['input']) }}'); tooltip = true; setTimeout(() => tooltip = false, 1000)" >

                <div class="relative" x-cloak x-show="tooltip">
                    <div class="absolute top-0 z-10 p-2 -mt-1 text-sm leading-tight text-gray-700 transform -translate-x-1/2 -translate-y-full bg-white border-t-4 border-gray-500 rounded-lg shadow-lg w-36">
                        Copied to Clipboard!
                    </div>
                    <svg class="absolute z-10 w-6 h-6 ml-8 text-white transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                        <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                    </svg>
                </div>
                <div class="w-12 h-12 mini-box @isset($item['id']) @if($item['id'] === 1 || in_array($item['id'], \App\Menus\Models\Menu::pluck('icon_id')->toArray())) bg-indigo-300 @endif @endisset">
                    {!! $item['art'] !!}
                </div>

                {{-- <x-slot name="caption">
                    <input readonly type="text" class="w-16 h-3 p-0 m-0 text-xs leading-none tracking-tighter border-none ring-0" value="{{ $item['input'] }}" />
                </x-slot> --}}

            </x-compact-article-stacked>


        @empty
            <x-compact-article-stacked>

                <svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

                <x-slot name="caption">
                    {{__('No Items')}}
                </x-slot>
            </x-compact-article-stacked>
        @endforelse
    </x-compact-grid>
</div>
