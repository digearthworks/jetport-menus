<div x-data="{ menuType: '{{isset($state['type']) ? $state['type'] : 'main_menu'}}' }">

    @if(isset($item) && $item)
        @include('admin.menus.includes.form.select-menu')
    @endif

    @include('admin.menus.includes.form.name')

    @include('admin.menus.includes.form.handle')

    @include('admin.menus.includes.form.title')

    @include('admin.menus.includes.form.select-type')

    <!-- Only shows if type is admin -->
    <div x-cloak x-show="menuType !='main_menu'">
        @include('admin.menus.includes.form.link')
    </div>

    @include('admin.menus.includes.form.select-active')

    @include('admin.menus.includes.form.sort')

    @if(isset($item) && $item)
        @include('admin.menus.includes.form.select-item-group')
    @else
        @include('admin.menus.includes.form.select-group')
    @endif

    <div x-data="{ menuGroup: '{{ isset($model->group) ? $model->group : 'app'}}' }">

    </div>

    @include('admin.menus.includes.form.icon-editor')
</div>
