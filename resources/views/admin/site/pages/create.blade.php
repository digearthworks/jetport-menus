<x-dialog-modal maxWidth="2xl" :overflowHidden="false" wire:model="creatingResource">

    <x-slot name="title">
        {{ __('New Web Page') }}
    </x-slot>

    <x-slot name="content">
        @include('admin.site.pages.includes.partials.form-content')
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeCreateDialog" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="createSitePage" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-dialog-modal>
