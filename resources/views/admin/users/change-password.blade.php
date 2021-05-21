<x-dialog-modal maxWidth="2xl" wire:model="editingUserPassword">

    <x-slot name="title">
        {{__('Change Password for ')}} {{$user->name ?? ''}}
    </x-slot>

    <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input type="text" name="password" class="block w-full mb-1" placeholder="{{ __('password') }}"
                        value="" maxlength="100"
                        wire:model.defer="state.password" required />
                    <x-input-error for="password" class="mt-2" />
                </div>
            </div>
            <div class="col-span-6 sm:col-span-4">

                <div>
                    <x-jet-label for="password_confirmation" value="{{ __('Password Confirmation') }}" />
                    <x-jet-input type="text" name="password_confirmation" class="block w-full mb-1" placeholder="{{ __('password confirmation') }}"
                        value="" maxlength="100"
                        wire:model.defer="state.password_confirmation" required />
                    <x-input-error for="password" class="mt-2" />
                </div>
            </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('editingUserPassword')" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="updateUserPassword" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-dialog-modal>
