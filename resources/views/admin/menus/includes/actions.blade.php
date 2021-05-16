<div class="flex items-center">
    <!-- todo: edit action -->
    <x-edit-button wire:click="openEditor({{ $model->id }})"
        id="editRoleButton_{{ $model->id }}" />
    <!-- todo: delete action -->
    <x-delete-button wire:click="confirmDelete({{ $model->id }})" />
</div>
