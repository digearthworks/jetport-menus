@foreach($menus as $menu)
    <x-navbar-menu-group :active="requestPathIs($menu->link) || requestPathIs($menu->children->pluck('link')->toArray())">
        <x-slot name="header">
            <a href="{{ $menu->uri }}" target="{{ $menu->target }}" >{{ $menu->name }}</a>
        </x-slot>

        @forelse($menu->children as $item)
            @if($loop->index === 3)
                @php break; @endphp
            @endif
            <x-navbar-menu-item>
                <x-navbar-item-link href="{{ $item->uri }}" :target="$menu->target" :active="requestPathIs($item->uri)">
                    <li class="list-none nav-box">
                        {!! $item->icon->art !!}
                    </li>
                </x-navbar-item-link>
            </x-navbar-menu-item>
        @empty
            <p>&nbsp;</p>
        @endforelse
    </x-navbar-menu-group>
@endforeach

