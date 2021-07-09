<x-7xl>
    <x-slot name="header">
        <div class="inline-flex items-center w-full">
            <div>
                {!! $parent->name !!}
            </div>
            @if($logged_in_user->isAdmin() || is_impersonating())
                <div x-cloak x-show="designerView === 'true'" class="ml-auto">
                    <x-edit-button class="z-50" onclick="window.livewire.emit('editDialog', {{ $parent->id }})" id="editMenuButton_{{ $parent->id }}" />
                    <x-delete-button class="z-50" onclick="window.livewire.emit('confirmDelete', {{ $parent->id }})" />

                    <livewire:turbine.menus.admin.create-menu-item-button
                        value="New Menu"
                        :params="[ 'item' => false, 'attach_for_user' => true ]"
                    />

                    <livewire:turbine.menus.admin.create-menu-item-button
                        value="New Item"
                        :params="[ 'item' => true, 'parent_id' => $parent->id, 'attach_for_user' => true ]"
                    />
                </div>
            @endif
        </div>
    </x-slot>
        <livewire:turbine.menus.main-menu :parentId="$parent->id" :designerView="request()->has('designerView')" />
        <livewire:turbine.menus.admin.create-menu-item-form />
        <livewire:turbine.menus.admin.edit-menu-item-form />
        <livewire:turbine.menus.admin.delete-menu-item-dialog />
</x-7xl>
