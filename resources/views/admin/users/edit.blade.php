

<x-dialog-modal maxWidth="2xl" wire:model="editingResource">

    <x-slot name="title">

    </x-slot>

    <x-slot name="content">
        <div x-data="{userType : '{{ $user->type ?? '' }}'}">
            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" name="name" class="block w-full mb-1" placeholder="{{ __('Name') }}"
                        value="{{ old('name') ?? ($user->name ?? '') }}" maxlength="100"
                        wire:model.defer="state.name" required />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
            </div>
            <!--form-group-->

            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input class="block w-full mb-1" type="email" name="email"
                        :value="old('email') ?? ($user->email ?? '' )" wire:model.defer="state.email" required
                        autofocus />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>
            </div>
            <!--form-group-->

            @if (isset($user) && $logged_in_user->isMasterAdmin() || isset($user) && !$user->isMasterAdmin())
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="updatingName" value="{{ __('Type') }}" />

                    <div class="col-span-6 sm:col-span-4">
                        <select name="type"
                            class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            x-on:change="userType = $event.target.value" wire:model.defer="state.type"
                            required>
                            <option value="{{ \Turbine\Auth\Enums\UserTypeEnum::user() }}">@lang('User')</option>
                            <option value="{{ \Turbine\Auth\Enums\UserTypeEnum::admin() }}">@lang('Administrator')</option>
                        </select>
                    </div>
                </div>
                <!--form-group-->
            @endif

            @include('admin.users.edit-checklists')

        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('editingResource')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="updateUser" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-dialog-modal>
