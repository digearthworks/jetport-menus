@foreach($menuItems as $menuItem)
    @if(($loop->index + $loop->parent->index) === config('turbine.menus.max_nav_menus'))
        @php break; @endphp
    @endif
        @includeIf('menu-item.navbar.'. $menuItem->template .'.index', ['menuItem' => $menuItem, 'designerView' => false])
@endforeach

