<div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
    @foreach($guestNavigationMenu->children as $menu)
        <x-jet-nav-link  href="{{ $menu->link }}" :active="currentRouteHas($menu->link)">
            {{__(':title', [ 'title' => isset($menu->page->name) ? $menu->page->name : $menu->name ])}}
        </x-jet-nav-link>
    @endforeach
    @if (Route::has('login'))
        @auth
            <x-jet-nav-link href="{{ url('/dashboard') }}" >Dashboard</x-jet-nav-link>
        @else
            <x-jet-nav-link href="{{ route('login') }}">Log in</x-jet-nav-link>

            @if (Route::has('register'))
                <x-jet-nav-link href="{{ route('register') }}">Register</x-jet-nav-link>
            @endif
        @endauth
    @endif
</div>
