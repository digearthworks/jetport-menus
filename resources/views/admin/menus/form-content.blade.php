<div x-data="{ menuType: '{{isset($state['type']) ? $state['type'] : 'main_menu'}}' }">

    @if(isset($item) && $item)
        @include('admin.menus.select-menu')
    @endif

    @include('admin.menus.name')

    @include('admin.menus.handle')

    @include('admin.menus.title')

    @if(isset($item) && $item)
        @include('admin.menus.select-item-type')
    @else
        @include('admin.menus.select-type')
    @endif



    <div x-cloak x-show="menuType !='main_menu' && menuType !='page' ">
        @include('admin.menus.link')
    </div>

    <div x-cloak x-show="menuType ==='page' ">
        @include('admin.menus.select-page')
    </div>

    @include('admin.menus.select-active')

    @include('admin.menus.sort')

    @if(isset($item) && $item)
        @include('admin.menus.select-item-group')
    @else
        @include('admin.menus.select-group')
    @endif

    <div x-data="{ menuGroup: '{{ isset($model->group) ? $model->group : 'app'}}' }">

    </div>

    @include('admin.icons.icon-editor')
</div>
