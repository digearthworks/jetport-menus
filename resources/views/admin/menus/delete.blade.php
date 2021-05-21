<x-jet-confirmation-modal wire:model="confirmingDelete">
    <x-slot name="title">
        {{ __('Delete Menu') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete') }} {{ $menu->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingDelete')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="deleteMenu"
            wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
