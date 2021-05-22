<x-7xl>
    <x-slot name="header">
        <div class="inline-flex items-center">
            {!! $menu->name_with_art !!}
        </div>
    </x-slot>
    <div class="p-4 justify-even">

        <div class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-8 gap-y-2 gap-x-0">
            @foreach($menu->children as $item)
                <x-page-article href="{{$item->link}}">

                    {!! $item->icon->art !!}

                    <x-slot name="caption">
                        {{ $item->name ?? $item->link }}
                    </x-slot>
                </x-page-article>
            @endforeach
        </div>
    </div>
</x-7xl>

