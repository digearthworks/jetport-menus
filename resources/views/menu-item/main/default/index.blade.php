@if(isset($designerView) && $designerView && ($logged_in_user->isAdmin() || is_impersonating()))
    @include('menu-item.main.default.designer')
@else
    @include('menu-item.main.default.template')
@endif
