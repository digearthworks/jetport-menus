
    @include('admin.menus.name')
    
    @include('admin.menus.handle')
    
    @if(isset($item) && $item)
    @include('admin.menus.select-menu')
    @else
    @include('admin.menus.select-item-group')
    
    @include('admin.menus.select-item-template')
    @endif
    
    @include('admin.menus.title')

    <div x-data="{ showPageDropdown: @entangle('showPageDropdown'), showLinkInput: @entangle('showLinkInput')  }">

    @include('admin.menus.select-item-type')

    <div x-cloak x-show="showLinkInput">
        @include('admin.menus.link')

        @include('admin.menus.select-target')
    </div>

    <div x-cloak x-show="showPageDropdown">
        @include('admin.menus.select-page')
    </div>

    @include('admin.menus.select-active')

    @include('admin.menus.sort')

    <div x-data="{ menuGroup: '{{ isset($model->group) ? $model->group : 'app'}}' }">

    </div>

    @include('admin.menus.icon-editor')
</div>
