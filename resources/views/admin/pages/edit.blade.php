<x-dialog-modal maxWidth="2xl" :overflowHidden="false" wire:model="editingResource">

    <x-slot name="title">
        {{ __('Edit Web Page') }}
    </x-slot>

    <x-slot name="content">
        @include('admin.pages.form-content')
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeEditDialog" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="updatePage" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>

        <x-jet-secondary-button class="ml-2" wire:click="savePageAs" wire:loading.attr="disabled">
            {{ __('Save As') }}
        </x-jet-secondary-button>
    </x-slot>

</x-dialog-modal>
