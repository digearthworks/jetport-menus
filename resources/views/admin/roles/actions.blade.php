@inject('userModel', '\App\Core\Auth\Models\User')
@if (!$model->isAdmin() && ($logged_in_user->hasAllAccess() || $model->type == $userModel::TYPE_USER))
    <div class="flex items-center">
        <!-- todo: edit action -->
        <x-edit-button wire:click="dialog('edit', {{ $model->id }})"
            id="editRoleButton_{{ $model->id }}" />
        <!-- todo: delete action -->
        <x-delete-button wire:click="confirm('delete', {{ $model->id }})" />
    </div>
@endif
