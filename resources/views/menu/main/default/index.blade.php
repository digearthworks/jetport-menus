<div>
    @if(isset($designerView) && $designerView && ($logged_in_user->isAdmin() || is_impersonating()))
        @include('menu.main.default.designer')
    @else
        @include('menu.main.default.template')
    @endif
</div>
