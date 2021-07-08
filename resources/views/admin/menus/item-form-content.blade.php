<div x-data="{ menuType: '{{isset($state['type']) ? $state['type'] : \Turbine\Menus\Enums\MenuItemTypeEnum::menu_item() }}' }">

    @include('admin.menus.name')

    @include('admin.menus.handle')

    @if(isset($item) && $item)
        @include('admin.menus.select-menu')
    @else
        @include('admin.menus.select-item-group')
        
        @include('admin.menus.select-item-template')
    @endif

    @include('admin.menus.title')

    @include('admin.menus.select-item-type')

    <div x-cloak x-show="menuType !='{{ \Turbine\Menus\Enums\MenuItemTypeEnum::menu_link() }}' && menuType !='{{ \Turbine\Menus\Enums\MenuItemTypeEnum::page_link() }}'">
        @include('admin.menus.link')

        @include('admin.menus.select-target')
    </div>

    <div x-cloak x-show="menuType ==='{{ \Turbine\Menus\Enums\MenuItemTypeEnum::page_link() }}' ">
        @include('admin.menus.select-page')
    </div>

    @include('admin.menus.select-active')

    @include('admin.menus.sort')

    <div x-data="{ menuGroup: '{{ isset($model->group) ? $model->group : 'app'}}' }">

    </div>

    @include('admin.menus.icon-editor')
</div>
