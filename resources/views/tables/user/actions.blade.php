<div x-data="{
    userId : 0,
    editingUser : false
}">
    @inject('model', '\App\Models\User')

    @if ($user->trashed() && $logged_in_user->hasAllAccess())
        <x-button wire:click="confirmUserRestore({{ $user->id }})">
            {{ __('Restore') }}
        </x-button>

        @if (config('jetport.auth.access.user.permanently_delete'))

            <x-button wire:click="confirmPermanentDelete({{ $user->id }})">
                {{ __('Delete') }}
            </x-button>
        @endif

    @else
        @if ($logged_in_user->hasAllAccess())
            <x-edit-button x-on:click="editingUser = true; userId = {{ $user->id }}"
                id="editUserButton_{{ $user->id }}" wire:click="editUser({{ $user->id }})">
            </x-edit-button>
        @endif

    @endif

    {{-- <x-jet-confirmation-modal wire:model="confirmingUserRestore">
        <x-slot name="title">
            {{ __('Restore user') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to restore') }} {{ $user->name }} ?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingUserRestore')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="$toggle('confirmingUserRestore')"
                wire:loading.attr="disabled">
                {{ __('Restore') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <x-jet-confirmation-modal wire:model="confirmingPermanentDelete">
        <x-slot name="title">
            {{ __('Permanentely Delete user') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to Permanentely Delete') }} {{ $user->name }} ?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingPermanentDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-danger-button class="ml-2" wire:click="$toggle('confirmingPermanentDelete')"
                wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-jet-confirmation-modal> --}}

    <div x-show="editingUser === true && userId === {{ $user->id }}">
        <livewire:edit-user :userId="$user->id" :key="$user->id" />
    </div>
</div>
