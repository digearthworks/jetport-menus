

<x-dialog-modal maxWidth="2xl" wire:model="creatingResource">

    <x-slot name="title">

    </x-slot>

    <x-slot name="content">
        <div x-data="{userType : 'user'}">
            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" name="name" class="block w-full mb-1" placeholder="{{ __('Name') }}"
                        maxlength="100"
                        wire:model.defer="state.name" required />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
            </div>
            <!--form-group-->

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
            @include('admin.roles.checklists')

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
