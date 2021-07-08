<div class="p-4">
    <div class="grid grid-cols-3">
        @include('admin.pages.template-form-content')
        <div class="px-2">

        </div>
        <div class="pt-4 pr-2">
            <x-jet-button wire:click="$emit('storing-template')" wire:loading.attr="disabled"
                class="float-right"
            >
                {{ __('Save') }}
            </x-jet-button>
        </div>
    </div>
    @include('admin.pages.grapejs')

</div>

