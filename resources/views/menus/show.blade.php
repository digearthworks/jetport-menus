<x-7xl>
    <x-slot name="header">
        <div class="inline-flex items-center">
            {!! $menu->name_with_art !!}
            @if($logged_in_user->isAdmin())
                <x-edit-button class="z-50" x-show="designerView" onclick="window.livewire.emit('editDialog', {{ $menu->id }})" id="editMenuButton_{{ $menu->id }}" />
                <x-delete-button class="z-50" x-show="designerView" onclick="window.livewire.emit('confirmDelete', {{ $menu->id }})" />
            @endif
        </div>
    </x-slot>
    @if($logged_in_user->isAdmin())
        <x-slot name="headerActions">
            <div x-show="designerView" class="flex items-center">
                <livewire:admin.menus.includes.partials.create-menu-button value="Add Item" :params="['item' => true, 'menu_id' => $menu->id ]" wire:key="table-row-{{ $menu->uuid }}-column-6-button" />
        </x-slot>
    @endif

        <livewire:menu.menu-grid :menuId="$menu->id" />
</x-7xl>
@if($logged_in_user->isAdmin())
    <livewire:admin.menus.create />
    <livewire:admin.menus.edit />
    <livewire:admin.menus.delete />
@endif
