<x-jet-confirmation-modal wire:model="confirmingDeactivateUser">
    <x-slot name="title">
        {{ __('Deactivate user') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to Deactivate') }} {{ $user->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingDeactivateUser')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="DeactivateUser"
            wire:loading.attr="disabled">
            {{ __('Deactivate') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
