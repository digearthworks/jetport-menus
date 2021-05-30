<div x-data="{
    openTab: 1,
    open: false,
    activeClasses: 'border-l border-t border-r rounded-t text-blue-700',
    inactiveClasses: 'text-blue-500 hover:text-blue-800'
    }"
    class="col-span-6 sm:col-span-4">
    <x-jet-label for="active" value="{{ __('Icon') }}" />

    <div class="flex justify-around p-2">
        <x-article-stacked>

            <div class="w-24 h-24 ml-auto mr-auto picture-box">
                {!! $iconPreview ?? '' !!}
            </div>

            <x-slot name="caption">
                <p class="ml-auto mr-auto overflow-hidden leading-none tracking-tighter">
                    {{ (strlen($state['name']) > 0) ? $state['name'] : 'Menu Name ...' }}
                </p>
            </x-slot>
        </x-article-stacked>
    </div>

    <x-textarea
        id="select-from-existing-icons"
        name="icon_id"
        rows="5"
        wire:model="state.icon_id"
        wire:keyup="reloadIconPreview"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    />
    <x-input-error for="icon_id" class="mt-2" />
    <x-form-help-text value="You may select from below, or enter raw html, or class name for font awesome" />

    <livewire:admin.icons.icon-select />
</div>
