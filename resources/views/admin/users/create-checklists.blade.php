<!-- Only shows if type is admin -->
<div x-cloak x-show="userType === '{{ \Turbine\Auth\Enums\UserTypeEnum::admin() }}'">

    @include('admin.roles.admin-checklist')

    @include('admin.menus.admin-checklist')

    @include('admin.permissions.admin-checklist')

</div>

<!-- Only shows if type is user -->
<div x-cloak x-show="userType === '{{ \Turbine\Auth\Enums\UserTypeEnum::user() }}'">

    @include('admin.roles.user-checklist')

    @include('admin.menus.user-checklist')

    @include('admin.permissions.user-checklist')

</div>
