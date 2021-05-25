@foreach($logged_in_user->app_menus as $menu)
    <x-header-menu-group :active="currentRouteHas($menu->link) || currentRouteHas($menu->children->pluck('link')->toArray())">
        <x-slot name="header">
            <a href="{{ $menu->link }}">{{ $menu->name }}</a>
        </x-slot>

        @forelse($menu->hotlinks as $item)
            <x-header-menu-item>
                <x-header-item-link href="{{ $item->link }}" :active="currentRouteHas($item->link)">
                    {!! $item->icon->art !!}
                </x-header-item-link>
            </x-header-menu-item>
        @empty
            <p>&nbsp;</p>
        @endforelse
    </x-header-menu-group>
@endforeach
