<x-jet-confirmation-modal wire:model="confirmingDeleteRole">
    <x-slot name="title">
        {{ __('Delete Role') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to delete') }} {{ $role->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingDeleteRole')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="deleteRole"
            wire:loading.attr="disabled">
            {{ __('Delete') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
