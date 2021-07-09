<div x-cloak x-show="userType === '{{ \Turbine\Auth\Enums\UserTypeEnum::admin() }}'">
    @include('admin.menus.admin-checklist')
    @include('admin.permissions.admin-checklist')
</div>

<!-- Only shows if type is user -->
<div x-cloak x-show="userType === '{{ \Turbine\Auth\Enums\UserTypeEnum::user() }}'">
    @include('admin.menus.user-checklist')
    @include('admin.permissions.user-checklist')
</div>
