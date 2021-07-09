<x-7xl>
    <x-slot name="header">
        <div class="inline-flex items-center w-full">
            <div>
                @if($logged_in_user->isAdmin())
                {{__('Welcome, Admin.')}}
                @else
                {{__('Welcome, :user!', ['user' => $logged_in_user->name])}}
                @endif
            </div>
                @if($logged_in_user->isAdmin() || is_impersonating())
                <div x-cloak x-show="designerView === 'true'" class="ml-auto">

                    <livewire:turbine.menus.admin.create-menu-item-button
                        value="New Menu"
                        :params="[ 'item' => false, 'attach_for_user' => true ]"
                    />

                    <livewire:turbine.menus.admin.create-menu-item-button
                        value="New Item"
                        :params="[ 'item' => true, 'attach_for_user' => true ]"
                    />
                </div>
            @endif

        </div>

    </x-slot>
        <livewire:turbine.menus.dashboard-menu :designerView="request()->has('designerView')" />
        <livewire:turbine.menus.admin.create-menu-item-form />
        <livewire:turbine.menus.admin.edit-menu-item-form />
        <livewire:turbine.menus.admin.delete-menu-item-dialog />
</x-7xl>
