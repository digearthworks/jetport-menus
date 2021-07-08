<div class="p-4">
    <div class="grid grid-cols-3">
        @include('admin.pages.template-form-content')
        <div class="px-2">

        </div>

        <div class="pt-4 pr-2">
            <x-jet-secondary-button
                wire:click="$emit('saving-template-as')"
                wire:loading.attr="disabled"
                class="float-right mb-2 ml-2"
            >
                {{ __('Save As Copy') }}
            </x-jet-secondary-button>

            <x-jet-button
                wire:click="$emit('updating-template')"
                wire:loading.attr="disabled"
                class="float-right px-2 mb-2"
            >
                {{ __('Save') }}
            </x-jet-button>
        </div>
    </div>
    @include('admin.pages.grapejs')

</div>
