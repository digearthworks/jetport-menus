<x-jet-confirmation-modal wire:model="confirmingDeleteUser">
    <x-slot name="title">
        {{ __('Delete user') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete') }} {{ $user->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingDeleteUser')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="deleteUser"
            wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
