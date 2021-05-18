@inject('model', '\App\Models\User')
<x-dialog-modal maxWidth="2xl" wire:model="editing">

    <x-slot name="title">

    </x-slot>

    <x-slot name="content">
        @include('admin.menus.includes.partials.form-body')
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeEditDialog" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="updateMenu" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>

        <x-jet-secondary-button class="ml-2" wire:click="saveMenuAs" wire:loading.attr="disabled">
            {{ __('Save As New') }}
        </x-jet-secondary-button>
    </x-slot>

</x-dialog-modal>
