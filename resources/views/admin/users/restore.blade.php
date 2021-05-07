<x-jet-confirmation-modal wire:model="confirmingRestoreUser">
    <x-slot name="title">
        {{ __('Restore user') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to Restore') }} {{ $user->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingRestoreUser')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="restoreUser"
            wire:loading.attr="disabled">
            {{ __('Restore') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
