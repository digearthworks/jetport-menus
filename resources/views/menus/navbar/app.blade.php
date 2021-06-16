@foreach($logged_in_user->app_menus as $menu)
    <x-navbar-menu-group :active="requestPathIs($menu->link) || requestPathIs($menu->children->pluck('link')->toArray())">
        <x-slot name="header">
            <a href="{{ $menu->link }}" @if($menu->type == 'external_link') target="_blank" @endif >{{ $menu->name }}</a>
        </x-slot>

        @forelse($menu->navigation as $item)
            <x-navbar-menu-item>
                <x-navbar-item-link href="{{ $item->link }}" :target="($item->type == 'external_link') ? '_blank' : null" :active="requestPathIs($item->link)">
                    {!! $item->icon->art !!}
                </x-navbar-item-link>
            </x-navbar-menu-item>
        @empty
            <p>&nbsp;</p>
        @endforelse
    </x-navbar-menu-group>
@endforeach
