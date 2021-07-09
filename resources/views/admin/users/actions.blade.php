<div class="flex items-center">
    @inject('model', '\Turbine\Auth\Models\User')

    @if ($user->trashed() && $logged_in_user->hasAllAccess())
        <x-button wire:click="confirm('restore',{{ $user->id }})">
            {{ __('Restore') }}
        </x-button>
    @else
        @if (!$user->hasAllAccess() || $logged_in_user->hasAllAccess())
            <x-edit-button wire:click="dialog('edit',{{ $user->id }})"
                id="editUserButton_{{ $user->id }}">
            </x-edit-button>
        @endif
        @if (! $user->isActive())
            <x-refresh-button wire:click="confirm('reactivate', {{ $user->id }})">
            </x-refresh-button>
        @endif
        @if (
            $user->id !== $logged_in_user->id && !$user->isMasterAdmin() && (!$user->hasAllAccess() || $logged_in_user->hasAllAccess()))
            <x-delete-button wire:click="confirm('delete',{{ $user->id }})">
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
                        <x-jet-dropdown-link href="#" wire:click="dialog('editPassword',{{ $user->id }})">
                            {{__('Change Password')}}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
            @elseif (
                        $logged_in_user->isMasterAdmin() || // the logged in user is master admin
                        !$user->isMasterAdmin() && // This is not the master admin
                        $user->isActive() && // The account is active
                        $user->id !== $logged_in_user->id && // It's not the person logged in
                        $logged_in_user->hasAllPermissions($user->getAllPermissions()->pluck('name')->toArray()) &&
                        ( !$user->hasAllAccess() || $logged_in_user->hasAllAccess() ) && // do not allow escalation
                        // Any they have at lease one of the abilities in this dropdown
                        (
                            $logged_in_user->can('admin.access.users.change-password') ||
                            $logged_in_user->can('admin.access.users.clear-session') ||
                            $logged_in_user->can('admin.access.users.impersonate') ||
                            $logged_in_user->can('admin.access.users.deactivate')
                        )
                    )
                <x-jet-dropdown align="left" width="48" dropdownClasses="z-50">
                    <x-slot name="trigger">
                        <x-dropdown-button>
                            {{ __('More') }}
                        </x-dropdown-button>
                    </x-slot>

                    <x-slot name="content">

                        <x-jet-dropdown-link href="#" wire:click="dialog('editPassword',{{ $user->id }})">
                            {{__('Change Password')}}
                        </x-jet-dropdown-link>

                        @if ($user->id !== $logged_in_user->id && !$user->isMasterAdmin())
                            <x-jet-dropdown-link href="#" wire:click="confirm('clearSessions', {{ $user->id }})">
                                    {{__('Clear Sessions')}}
                            </x-jet-dropdown-link>

                            @canBeImpersonated($user)
                                <x-jet-dropdown-link href="{{ route('impersonate', $user->id)}}">
                                        {{ __('Login as') }} {{ $user->name }}
                                </x-jet-dropdown-link>
                            @endCanBeImpersonated

                            <x-jet-dropdown-link href="#" wire:click="confirm('deactivate', {{ $user->id }})">
                                {{__('Deactivate')}}
                            </x-jet-dropdown-link>

                        @endif

                    </x-slot>

                </x-jet-dropdown>

            @endif
        </div>

    @endif
</div>
