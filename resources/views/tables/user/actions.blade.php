<div class="flex items-center">
    @inject('model', '\App\Models\User')

    @if ($user->trashed() && $logged_in_user->hasAllAccess())
        <x-button wire:click="confirmRestoreUser({{ $user->id }})">
            {{ __('Restore') }}
        </x-button>
    @else
        @if ($logged_in_user->hasAllAccess())
            <x-edit-button wire:click="openEditorForUser({{ $user->id }})"
                id="editUserButton_{{ $user->id }}">
            </x-edit-button>
        @endif
        @if (! $user->isActive())
            <x-refresh-button wire:click="confirmReactivateUser({{ $user->id }})">
            </x-refresh-button>
        @endif
        @if ($user->id !== $logged_in_user->id && !$user->isMasterAdmin() && $logged_in_user->hasAllAccess())
            <x-delete-button wire:click="confirmDeleteUser({{ $user->id }})">
            </x-delete-button>
        @endif

        <div class="relative ml-3 z">

            @if ($user->isMasterAdmin() && $logged_in_user->isMasterAdmin())
                <x-jet-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <x-dropdown-button>
                            {{ __('More') }}
                        </x-dropdown-button>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="#" wire:click="openEditorForUserPassword({{ $user->id }})">
                            {{__('Change Password')}}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
            @elseif (
                        !$user->isMasterAdmin() && // This is not the master admin
                        $user->isActive() && // The account is active
                        $user->id !== $logged_in_user->id && // It's not the person logged in
                        // Any they have at lease one of the abilities in this dropdown
                        (
                            $logged_in_user->can('admin.access.user.change-password') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.deactivate')
                        )
                    )
                <x-jet-dropdown align="left" width="48" dropdownClasses="z-50">
                    <x-slot name="trigger">
                        <x-dropdown-button>
                            {{ __('More') }}
                        </x-dropdown-button>
                    </x-slot>

                    <x-slot name="content">

                        <x-jet-dropdown-link href="#" wire:click="openEditorForUserPassword({{ $user->id }})">
                            {{__('Change Password')}}
                        </x-jet-dropdown-link>

                        @if ($user->id !== $logged_in_user->id && !$user->isMasterAdmin())
                            <x-jet-dropdown-link href="#" wire:click="confirmClearSessions({{ $user->id }})">
                                    {{__('Clear Sessions')}}
                            </x-jet-dropdown-link>

                            @canBeImpersonated($user)
                                <x-jet-dropdown-link href="{{ route('impersonate', $user->id)}}">
                                        {{ __('Impersonate') }}
                                </x-jet-dropdown-link>
                            @endCanBeImpersonated

                            <x-jet-dropdown-link href="#" wire:click="confirmDeactivateUser({{ $user->id }})">
                                {{__('Deactivate')}}
                            </x-jet-dropdown-link>

                        @endif

                    </x-slot>

                </x-jet-dropdown>

            @endif
        </div>

    @endif

</div>
