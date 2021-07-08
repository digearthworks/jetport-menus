<div x-data="{
    openTab: 1,
    open: false,
    activeClasses: 'border-l border-t border-r rounded-t text-blue-700',
    inactiveClasses: 'text-blue-500 hover:text-blue-800'
    }"
    class="col-span-6 sm:col-span-4">
    <x-jet-label for="active" value="{{ __('Icon Selector') }}" />

    <x-article-stacked class="w-full overflow-hidden text-gray-500 bg-white cursor-pointer hover:text-gray-900 hover:bg-gray-50 focus:bg-gray-50">

        <div class="w-24 h-24 ml-auto mr-auto picture-box">
            {{ svg($iconPreview ?? 'carbon-no-image-32') }}
        </div>

        <x-slot name="caption">
            <p class="ml-auto mr-auto overflow-hidden leading-none tracking-tighter">
                {{ (strlen($state['name']) > 0) ? $state['name'] : 'Name ...' }}
            </p>
        </x-slot>
    </x-article-stacked>

    <x-jet-input-error for="icon_id" class="mt-2" />
    <livewire:turbine.menus.admin.icon-select />
</div>
