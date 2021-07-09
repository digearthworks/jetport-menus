<!-- Only shows if type is admin -->
<div x-cloak x-show="userType === '{{ \Turbine\Auth\Enums\UserTypeEnum::admin() }}'">
    @if (isset($user) && !$user->isMasterAdmin() && $logged_in_user->hasAllAccess())
        @include('admin.roles.admin-checklist')
    @endif

    @if(isset($user) && $logged_in_user->isMasterAdmin() || isset($user) && !$user->isMasterAdmin())
        @include('admin.menus.admin-checklist')
    @endif

    @if (isset($user) && !$user->isMasterAdmin() && $logged_in_user->hasAllAccess())
        @include('admin.permissions.admin-checklist')
    @endif
</div>

<!-- Only shows if type is user -->
<div x-cloak x-show="userType === '{{ \Turbine\Auth\Enums\UserTypeEnum::user() }}'">

    @if (isset($user) && !$user->isMasterAdmin())
        @include('admin.roles.user-checklist')
    @endif
    @if(isset($user) && $logged_in_user->isMasterAdmin() || isset($user) && !$user->isMasterAdmin())
        @include('admin.menus.user-checklist')
    @endif
    @if (isset($user) && !$user->isMasterAdmin())
        @include('admin.permissions.user-checklist')
    @endif
</div>
