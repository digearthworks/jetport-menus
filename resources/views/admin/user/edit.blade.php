@inject('model', '\App\Models\User')

<x-jet-dialog-modal wire:model="editingUser">

    <x-slot name="title">

    </x-slot>

    <x-slot name="content">
        <div x-data="{userType : '{{ $user->type }}'}">
            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" name="name" class="mb-1 block w-full" placeholder="{{ __('Name') }}"
                        value="{{ old('name') ?? $user->name }}" maxlength="100" wire:model.defer="updateUserForm.name"
                        required />
                </div>
            </div>
            <!--form-group-->

            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input class="mb-1 block w-full" type="email" name="email" :value="old('email') ?? $user->email"
                        wire:model.defer="updateUserForm.email" required autofocus />
                </div>
            </div>
            <!--form-group-->

            @if (!$user->isMasterAdmin())
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="updatingName" value="{{ __('Type') }}" />

                    <div class="col-span-6 sm:col-span-4">
                        <select name="type"
                            class="mb-2 form-select block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            x-on:change="userType = $event.target.value"
                            wire:model.defer="updateUserForm.type" required>
                            <option value="{{ $model::TYPE_USER }}">@lang('User')</option>
                            <option value="{{ $model::TYPE_ADMIN }}">@lang('Administrator')</option>
                        </select>
                    </div>
                </div>
                <!--form-group-->
            @endif

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="underline" for="updatingMenus" value="{{ __('Menus') }}" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2">
                @foreach ($menus as $menu)
                    <div
                        class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                        <label class="flex items-center">
                            <x-jet-checkbox wire:model.defer="updateUserForm.menus" :value="$menu->id" />
                            <span class="px-1 text-gray-600">{!! $menu->icon->art !!}</span><span
                                class="text-sm text-gray-600">{{ $menu->label }}</span>
                        </label>

                        @if ($menu->children()->count())
                            <blockquote class="ml-3 text-gray-700">
                                @foreach ($menu->children as $link)
                                    <i class="fa fa-check-circle"></i> {!! $link->icon->art !!} {{ $link->link }}
                                    @if (isset($link->title))
                                        <small>{{ $link->title }}</small>
                                    @endif<br />
                                @endforeach
                            </blockquote>
                        @else
                            <blockquote class="ml-3 text-gray-700">
                                <i class="fa fa-minus-circle"></i> @lang('No Items')
                            </blockquote>
                        @endif
                    </div>
                @endforeach
            </div>

            @if (!$user->isMasterAdmin())
                <!-- Only shows if type is admin -->
                <div x-show="userType === '{{ $model::TYPE_ADMIN }}'" >

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label class="underline" for="updatingRoles" value="{{ __('Roles') }}" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @foreach ($roles->where('type',  $model::TYPE_ADMIN) as $role)
                            <div
                                class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                                <label class="flex items-center">
                                    <x-jet-checkbox wire:model.defer="updateUserForm.roles" :value="$role->id" />
                                    <span class="text-sm text-gray-600">{{ $role->name }}</span>
                                </label>

                                @if ($role->name === 'Administrator')
                                    <i class="fa fa-check-circle"></i> @lang('All Permissions')<br />
                                @elseif ($role->permissions->count())

                                    <blockquote class="ml-3 text-gray-700">
                                        @foreach ($role->permissions as $permission)
                                            <i class="fa fa-check-circle"></i> {{ $permission->description }}<br />
                                        @endforeach
                                    </blockquote>
                                @else
                                    <blockquote class="ml-3 text-gray-700">
                                        <i class="fa fa-minus-circle"></i> @lang('No Items')
                                    </blockquote>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>

                <!-- Only shows if type is user -->
                <div x-show="userType === '{{ $model::TYPE_USER }}'" >

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label class="underline" for="updatingRoles" value="{{ __('Roles') }}" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        @foreach ($roles->where('type',  $model::TYPE_USER) as $role)
                            <div
                                class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                                <label class="flex items-center">
                                    <x-jet-checkbox wire:model.defer="updateUserForm.roles" :value="$role->id" />
                                    <span class="text-sm text-gray-600">{{ $role->name }}</span>
                                </label>

                                @if ($role->name === 'Administrator')
                                    <i class="fa fa-check-circle"></i> @lang('All Permissions')<br />
                                @elseif ($role->permissions->count())

                                    <blockquote class="ml-3 text-gray-700">
                                        @foreach ($role->permissions as $permission)
                                            <i class="fa fa-check-circle"></i> {{ $permission->description }}<br />
                                        @endforeach
                                    </blockquote>
                                @else
                                    <blockquote class="ml-3 text-gray-700">
                                        <i class="fa fa-minus-circle"></i> @lang('No Items')
                                    </blockquote>
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>


            @endif
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('editingUser', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="updateUser" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-jet-dialog-modal>
