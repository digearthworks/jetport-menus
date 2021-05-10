@if (!$model->isAdmin())
    <div class="flex items-center">
        <!-- todo: edit action -->
        <x-edit-button wire:click="openEditorForRole({{ $model->id }})"
            id="editRoleButton_{{ $model->id }}" />
        <!-- todo: delete action -->
        <x-delete-button wire:click="confirmDeleteRole({{ $model->id }})" />
    </div>
@endif
