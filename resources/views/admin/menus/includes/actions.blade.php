<div class="flex items-center">
    <!-- todo: edit action -->
    @if ($model->trashed() && $logged_in_user->hasAllAccess())
        <x-button wire:click="confirm('restore', {{ $model->id }})">
            {{ __('Restore') }}
        </x-button>
    @else

        <x-edit-button wire:click="dialog('edit', {{ $model->id }})" id="editRoleButton_{{ $model->id }}" />
        <!-- todo: delete action -->
        <x-delete-button wire:click="confirm('delete', {{ $model->id }})" />

        @if (! $model->isActive())
            <x-refresh-button wire:click="confirm('reactivate', {{ $model->id }})">
            </x-refresh-button>
        @else
            <x-ban-button title="Deactivate" wire:click="confirm('deactivate', {{ $model->id }})" />
        @endif

    @endif
</div>
