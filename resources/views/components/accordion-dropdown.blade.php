<div x-data="{ open: '{{ $menuOpen[$menu->handle] ?? config('menus.admin_sidebar_default_open', true ) }}' }">
    <button @click="open = !open" wire:click="toggleMenuState('{{ $menu->handle }}')"
        class="flex items-center justify-between w-full px-2 py-3 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
        <span class="flex items-center">
            @isset($header)
                {{ $header }}
            @else
            <!-- Menu Icon -->
            {{ svg($menu->icon->name ?? 'carbon-no-image-32', 'w-8 h-8') }}
                <span class="mx-2 font-medium">{{ $menu->name ?? '' }}</span>
            @endisset
        </span>

        <span>
            <!-- arrow toggle -->
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-cloak x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-cloak x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
    </button>
    {{ $slot ?? '' }}
    <div x-cloak x-show="open" class="ml-4">

            @foreach($menu->children as $menuItem)

                @if($menuItem->children()->exists())
                    <x-accordion-dropdown
                        :menu="$menuItem"
                        :menuOpen="$menuOpen"
                    />
                @else
                    <x-sidebar-link
                        href="{{ $menuItem->uri }}"
                        target="{{ $menuItem->target }}"
                        :active="requestPathIs($menuItem->uri) ||
                            (
                                $menuItem->children()->exists() &&
                                requestPathIs($menuItem->children()->pluck('uri')->toArray())
                            )"
                        >
                        <span class="mr-1">{{ svg($menuItem->icon->name ?? 'carbon-no-image-32', 'w-4 h-4') }}</span>{{$menuItem->name}}
                    </x-sidebar-link>
                @endif
            @endforeach
    </div>
</div>
