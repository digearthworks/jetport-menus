<div>
    <x-app-grid wire:sortable="updateSort" class="border border-dashed" >
        @forelse($parent->authChildren as $item)
            @includeIf('menu-item.main.'. $item->template .'.index', ['item' => $item, 'designerView' => true])
        @empty
            <x-article-stacked>

                <svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>

                <x-slot name="caption">
                    {{__('No Items')}}
                </x-slot>
            </x-article-stacked>
        @endforelse
    </x-app-grid>
    {{-- {{ $menu->children->pluck('id') }}
    {{Auth::user()->getAllMenuItems()->pluck('id')}} --}}
</div>
