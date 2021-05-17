<div class="flex items-center">
    <!-- todo: edit action -->
    @if ($model->trashed() && $logged_in_user->hasAllAccess())
        <x-button wire:click="confirmRestore({{ $model->id }})">
            {{ __('Restore') }}
        </x-button>
    @else

        <x-edit-button wire:click="openEditor({{ $model->id }})"
            id="editRoleButton_{{ $model->id }}" />
        <!-- todo: delete action -->
        <x-delete-button wire:click="confirmDelete({{ $model->id }})" />

        @if (! $model->isActive())
            <x-refresh-button wire:click="$emit('confirmReactivate', {{ $model->id }})">
            </x-refresh-button>
        @else
            <x-ban-button title="Deactivate" wire:click="confirmDeactivate({{ $model->id }})" />
        @endif

    @endif
</div>
