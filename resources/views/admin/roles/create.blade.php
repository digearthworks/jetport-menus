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
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label class="underline" for="updatingRoles" value="{{ __('Permission Categories') }}" />
                </div>

                @if ($permissions->where('type', $model::TYPE_ADMIN )->whereNull('parent_id')->count())
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @foreach ($permissions->where('type', $model::TYPE_ADMIN )->whereNull('parent_id') as $permission)
                            <div
                                class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                                <label class="flex items-center">
                                    <x-jet-checkbox wire:model="createRoleForm.permissions" :value="$permission->id" />
                                    <span class="ml-1 text-sm text-gray-600">{{ $permission->description ?? $permission->name }}</span>
                                </label>

                                @if ($permission->children->count())
                                <li class="ml-4 list-none">
                                    @foreach($permission->children as $permissionChild)
                                    <ul>

                                        <label class="flex items-center">
                                            @if( in_array((string) $permission->id, $createRoleForm['permissions']))
                                                <svg class="w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>  <span class="ml-1 text-sm text-gray-600">{{ $permissionChild->description ?? $permissionChild->name }}</span>
                                            @else
                                                <x-jet-checkbox wire:model="createRoleForm.permissions" :value="$permissionChild->id" />
                                                <span class="ml-1 text-sm text-gray-600">{{ $permissionChild->description ?? $permissionChild->name }}</span>
                                            @endif
                                        </label>

                                    </ul>
                                    @endforeach
                                </li>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- Only shows if type is user -->
            <div x-show="userType === '{{ $model::TYPE_USER }}'">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label class="underline" for="updatingRoles" value="{{ __('Permission Categories') }}" />
                </div>

                @if ($permissions->where('type', $model::TYPE_USER )->whereNull('parent_id')->count())
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @foreach ($permissions->where('type', $model::TYPE_USER )->whereNull('parent_id') as $permission)
                            <div
                                class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                                <label class="flex items-center">
                                    <x-jet-checkbox wire:model="createRoleForm.permissions" :value="$permission->id" />
                                    <span class="ml-1 text-sm text-gray-600">{{ $permission->description ?? $permission->name }}</span>
                                </label>

                                @if ($permission->children->count())
                                <li class="ml-4 list-none">
                                    @foreach($permission->children as $permissionChild)
                                    <ul>

                                        <label class="flex items-center">
                                            @if( in_array((string) $permission->id, $createRoleForm['permissions']))
                                                <svg class="w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>  <span class="ml-1 text-sm text-gray-600">{{ $permissionChild->description ?? $permissionChild->name }}</span>
                                            @else
                                                <x-jet-checkbox wire:model="createRoleForm.permissions" :value="$permissionChild->id" />
                                                <span class="ml-1 text-sm text-gray-600">{{ $permissionChild->description ?? $permissionChild->name }}</span>
                                            @endif
                                        </label>

                                    </ul>
                                    @endforeach
                                </li>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
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
