<div>
    @if(isset($designerView) && $designerView && ($logged_in_user->isAdmin() || is_impersonating()))
        @include('menu.dashboard.default.designer')
    @else
        @include('menu.dashboard.default.template')
    @endif
</div>
