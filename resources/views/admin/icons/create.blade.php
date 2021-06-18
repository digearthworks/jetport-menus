<x-dialog-modal maxWidth="2xl" wire:model="creatingResource">

    <x-slot name="title">
        {{ __('Create Icon') }}
    </x-slot>

    <x-slot name="content">
        <div class="pb-4">
            @include('admin.icons.name')
        </div>
        @include('admin.icons.icon-editor')
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeCreateDialog" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="createIcon" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-dialog-modal>
