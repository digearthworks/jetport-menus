
<x-navbar-menu-group :active="requestPathIs($menuItem->uri) || requestPathIs($menuItem->authChildren->pluck('uri')->toArray())">
    <x-slot name="header">
        <x-jet-dropdown align="left" width="60">
            <x-slot name="trigger">
                <button class="flex flex-row items-center outline-none focus:outline-none">
                    <!-- Menu Icon -->
                        {{ svg($menuItem->icon->name ?? 'carbon-no-image-32', 'w-4 h-4') }} <span>{{ $menuItem->name }}</span>
        
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
            </x-slot>
        
            <x-slot name="content">
                <div class="w-60">
                    @foreach($menuItem->authChildren as $dropdownItem)
                        <x-jet-dropdown-link class="flex" href="{{ $dropdownItem->uri }}">
                            {{ svg($dropdownItem->icon->name ?? 'carbon-no-image-32', 'w-4 h-4') }}  <span>{{ $dropdownItem->name }}</span>
                        </x-jet-dropdown-link>
                    @endforeach
                </div>
            </x-slot>
        </x-jet-dropdown>
    </x-slot>

    <p>&nbsp;</p>

</x-navbar-menu-group>