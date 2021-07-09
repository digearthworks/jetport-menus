<x-jet-confirmation-modal wire:model="confirmingDeactivate">
    <x-slot name="title">
        {{ __('Deactivate Page') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to Deactivate') }} {{ $page->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingDeactivate')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="deactivatePage"
            wire:loading.attr="disabled">
            {{ __('Deactivate') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
