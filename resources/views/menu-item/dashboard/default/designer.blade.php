<x-article-stacked
wire:sortable.item="{{ $item->id ?? $item['id'] }}"
wire:key="item-{{ $item->id?? $item['id'] }}"
href="javascript:void(0)"
:target="$item->target ?? $item['target']"
class="border border-dashed">

<div class="w-24 h-24 ml-auto mr-auto picture-box">
{{ svg($item->icon->name ?? 'carbon-no-image-32', 'w-full h-full') }}
</div>

<x-slot name="caption">
<p class="ml-auto mr-auto overflow-hidden leading-none tracking-tighter">
    {{ $item->name ?? $item['name']}} sort:{{ $item->sort ?? $item['sort']}} id:{{ $item->id ?? $item['id']}}
</p>
</x-slot>

<div class="flex">
<x-edit-button-live class="z-50 -ml-24 bg-opacity-90" wire:model="designerView" wire:click="dialog('edit', {{ $item->id ?? $item['id'] }})" id="editMenuButton_{{ $item->id ?? $item['id'] }}" />
<x-delete-button-live class="z-50 bg-opacity-90 -ml-14 " wire:model="designerView" wire:click="confirm('delete', {{ $item->id ?? $item['id'] }})" />
</div>
</x-article-stacked>
