@if (!$model->isAdmin())
    <div class="flex items-center">
        <!-- todo: edit action -->
        <x-edit-button wire:click="dialog('edit', {{ $model->id }})"
            id="editRoleButton_{{ $model->id }}" />
        <!-- todo: delete action -->
        <x-delete-button wire:click="confirm('delete', {{ $model->id }})" />
    </div>
@endif
