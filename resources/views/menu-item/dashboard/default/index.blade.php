@if(isset($designerView) && $designerView && ($logged_in_user->isAdmin() || is_impersonating()))
    @include('menu-item.dashboard.default.designer')
@else
    @include('menu-item.dashboard.default.template')
@endif
