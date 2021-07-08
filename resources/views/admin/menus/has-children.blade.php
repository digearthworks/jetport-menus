<div class="flex items-center">
@if($menu->parent_id || $menu->page_id)
    <div x-data="{ input: '{{ url($menu->uri) }}' }">
        <input type="hidden" x-model="input">
        <button x-on:click="$clipboard(input)" class="flex items-center p-0.5 font-semibold text-gray-800  border border-gray-400 rounded shadow bg-gray-100"> @svg('heroicon-o-link', 'w-4 h-4')</button>
    </div>
@elseif($menu->isActive() && !$menu->trashed())
    <livewire:turbine.menus.admin.create-menu-item-button value="" :params="['item' => true, 'parent_id' => $menu->id ]" wire:key="table-row-{{ $menu->uuid }}-column-6-button" />
@endif
@if($menu->children()->exists())
<div wire:ignore.self>
    <button @click="open = ! open"
            class="flex items-center justify-between w-full px-2 py-3 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
        <span x-cloak>
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path x-cloak x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                <path x-cloak x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </span>
    </button>
</div>
@endif
</div>
