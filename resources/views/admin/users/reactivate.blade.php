<x-jet-confirmation-modal wire:model="confirmingReactivateUser">
    <x-slot name="title">
        {{ __('Reactivate user') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to Reactivate') }} {{ $user->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingReactivateUser')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="reactivateUser"
            wire:loading.attr="disabled">
            {{ __('Reactivate') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
