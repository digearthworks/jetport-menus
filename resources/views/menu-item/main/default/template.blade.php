<x-article-stacked
wire:key="item-{{ $item->uuid }}"
:href="$item->uri"
:target="$item->target" >

<div class="w-24 h-24 ml-auto mr-auto">
    {{ svg($item->icon->name ?? 'carbon-no-image-32', 'w-full h-full') }}
</div>

<x-slot name="caption">
    <p class="ml-auto mr-auto overflow-hidden leading-none tracking-tighter">
        {{ $item->name ?? $item->uri }}
    </p>
</x-slot>
</x-article-stacked>