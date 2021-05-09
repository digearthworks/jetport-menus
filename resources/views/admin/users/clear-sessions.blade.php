<x-jet-confirmation-modal wire:model="confirmingClearSessions">
    <x-slot name="title">
        {{ __('Delete user') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to logout all open sessions for') }} {{ $user->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingClearSessions')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="clearSessions"
            wire:loading.attr="disabled">
            {{ __('Clear Sessions') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
