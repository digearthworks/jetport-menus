@inject('model', '\App\Models\User')

<x-dialog-modal maxWidth="2xl" wire:model="creatingRole">

    <x-slot name="title">

    </x-slot>

    <x-slot name="content">
        <div x-data="{userType : 'user'}">
            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" name="name" class="block w-full mb-1" placeholder="{{ __('Name') }}"
                        maxlength="100"
                        wire:model.defer="createRoleForm.name" required />
                    <x-input-error for="name" class="mt-2" />
                </div>
            </div>
            <!--form-group-->

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="updatingName" value="{{ __('Type') }}" />

                <div class="col-span-6 sm:col-span-4">
                    <select name="type"
                        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        x-on:change="userType = $event.target.value" wire:model.defer="createRoleForm.type"
                        required>
                        <option value="{{ $model::TYPE_USER }}">@lang('User')</option>
                        <option value="{{ $model::TYPE_ADMIN }}">@lang('Administrator')</option>
                    </select>
                </div>
            </div>
            <!--form-group-->

            <!-- Only shows if type is admin -->
            <div x-show="userType === '{{ $model::TYPE_ADMIN }}'">

                <x-checklist-index
                    formIndex="permissions"
                    label="description"
                    childrenLabel="description"
                    relation="children"
                    :form="$createRoleForm ?? []"
                    formElement="createRoleForm.permissions"
                    :categories="$permissionCategories->where('type', $model::TYPE_ADMIN) ?? []"
                    :general="$generalPermissions->where('type', $model::TYPE_ADMIN) ?? []"
                    header="Permissions"
                />
            </div>

            <!-- Only shows if type is user -->
            <div x-show="userType === '{{ $model::TYPE_USER }}'">
                <x-checklist-index
                    formIndex="permissions"
                    label="description"
                    childrenLabel="description"
                    relation="children"
                    :form="$createRoleForm ?? []"
                    formElement="createRoleForm.permissions"
                    :categories="$permissionCategories->where('type', $model::TYPE_USER) ?? []"
                    :general="$generalPermissions->where('type', $model::TYPE_USER) ?? []"
                    header="Permissions"
                />
            </div>

        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeCreateDialog" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="createRole" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-dialog-modal>
