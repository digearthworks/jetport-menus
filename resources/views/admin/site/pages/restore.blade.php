<x-jet-confirmation-modal wire:model="confirmingRestore">
    <x-slot name="title">
        {{ __('Restore Menu') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Are you sure you want to Restore') }} {{ $page->name ?? '' }} ?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingRestore')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-danger-button class="ml-2" wire:click="restoreSitePage"
            wire:loading.attr="disabled">
            {{ __('Restore') }}
        </x-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
