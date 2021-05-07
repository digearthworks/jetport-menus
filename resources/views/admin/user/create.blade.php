

@inject('model', '\App\Models\User')
<div>
<x-jet-nav-link href="#" :active="$creatingUser" wire:click="openCreateDialog">
    {{__('New')}}
</x-jet-nav-link>

    <x-dialog-modal maxWidth="2xl" wire:model="creatingUser">

        <x-slot name="title">
            New User
        </x-slot>

        <x-slot name="content">
            <div x-data="{userType : '{{ $model::TYPE_USER }}'}">
                <div class="col-span-6 sm:col-span-4">

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input type="text" name="name" class="block w-full mb-1" placeholder="{{ __('Name') }}"
                            maxlength="100"
                            wire:model.defer="createUserForm.name" required />
                        <x-input-error for="name" class="mt-2" />
                    </div>
                </div>
                <!--form-group-->

                <div class="col-span-6 sm:col-span-4">

                    <div>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input class="block w-full mb-1" type="email" name="email"
                            wire:model.defer="createUserForm.email" required
                            autofocus />
                        <x-input-error for="email" class="mt-2" />
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4">

                    <div>
                        <x-jet-label for="password" value="{{ __('Password') }}" />

                        <x-password-input class="w-full" wire:model.defer="createUserForm.password" name="password" required />
                        <x-input-error for="password" class="mt-2" />
                    </div>
                </div>
                <!--form-group-->

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="creatingName" value="{{ __('Type') }}" />

                        <div class="col-span-6 sm:col-span-4">
                            <select name="type"
                                class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                x-on:change="userType = $event.target.value" wire:model.defer="createUserForm.type"
                                required>
                                <option value="{{ $model::TYPE_USER }}">@lang('User')</option>
                                <option value="{{ $model::TYPE_ADMIN }}">@lang('Administrator')</option>
                            </select>
                        </div>
                    </div>
                    <!--form-group-->

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label class="underline" for="creatingMenus" value="{{ __('Menus') }}" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2">
                    @foreach ($menus as $menu)
                        <div
                            class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                            <label class="flex items-center">
                                <x-jet-checkbox wire:model.defer="createUserForm.menus" :value="$menu->id" />
                                <span class="px-1 text-gray-600">{!! $menu->icon->art !!}</span><span
                                    class="text-sm text-gray-600">{{ $menu->label }}</span>
                            </label>

                            @if ($menu->children()->count())
                                <blockquote class="ml-3 text-sm text-gray-700">
                                    @foreach ($menu->children as $link)
                                        <i class="fa fa-check-circle"></i> {!! $link->icon->art !!} {{ $link->link }}
                                        @if (isset($link->title))
                                            <small>{{ $link->title }}</small>
                                        @endif<br />
                                    @endforeach
                                </blockquote>
                            @else
                                <blockquote class="ml-3 text-sm text-gray-700">
                                    <i class="fa fa-minus-circle"></i> @lang('No Items')
                                </blockquote>
                            @endif
                        </div>
                    @endforeach
                </div>

                    <!-- Only shows if type is admin -->
                    <div x-show="userType === '{{ $model::TYPE_ADMIN }}'">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label class="underline" for="creatingRoles" value="{{ __('Admin Roles') }}" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2">
                            @foreach ($roles->where('type', $model::TYPE_ADMIN) as $role)
                                <div
                                    class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                                    <label class="flex items-center">
                                        <x-jet-checkbox wire:model.defer="createUserForm.roles" :value="$role->id" />
                                        <span class="text-sm text-gray-600">{{ $role->name }}</span>
                                    </label>

                                    @if ($role->name === 'Administrator')
                                        <blockquote class="ml-3 text-sm text-gray-700">
                                            <i class="fa fa-check-circle"></i> @lang('All Permissions')<br />
                                        </blockquote>
                                    @elseif ($role->permissions->count())

                                        <blockquote class="ml-3 text-sm text-gray-700">
                                            @foreach ($role->permissions as $permission)
                                                <i class="fa fa-check-circle"></i> {{ $permission->description }}<br />
                                            @endforeach
                                        </blockquote>
                                    @else
                                        <blockquote class="ml-3 text-sm text-gray-700">
                                            <i class="fa fa-minus-circle"></i> @lang('No Items')
                                        </blockquote>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Only shows if type is user -->
                    <div x-show="userType === '{{ $model::TYPE_USER }}'">

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label class="underline" for="creatingRoles" value="{{ __('User Roles') }}" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2">
                            @foreach ($roles->where('type', $model::TYPE_USER) as $role)
                                <div
                                    class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                                    <label class="flex items-center">
                                        <x-jet-checkbox wire:model.defer="createUserForm.roles" :value="$role->id" />
                                        <span class="text-sm text-gray-600">{{ $role->name }}</span>
                                    </label>

                                    @if ($role->name === 'Administrator')
                                        <blockquote class="ml-3 text-sm text-gray-700">
                                            <i class="fa fa-check-circle"></i> @lang('All Permissions')<br />
                                        </blockquote>
                                    @elseif ($role->permissions->count())

                                        <blockquote class="ml-3 text-sm text-gray-700">
                                            @foreach ($role->permissions as $permission)
                                                <i class="fa fa-check-circle"></i> {{ $permission->description }}<br />
                                            @endforeach
                                        </blockquote>
                                    @else
                                        <blockquote class="ml-3 text-sm text-gray-700">
                                            <i class="fa fa-minus-circle"></i> @lang('No Items')
                                        </blockquote>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                    </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('creatingUser')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="createUser" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>

    </x-dialog-modal>
</div>
