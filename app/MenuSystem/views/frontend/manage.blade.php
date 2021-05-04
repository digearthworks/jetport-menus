@extends('frontend.layouts.app_menus')

@section('title', __('My Account'))
@push('head')
<link rel="stylesheet" href="/vendor/jquery-typeahead/dist/jquery.typeahead.min.css">
@endpush
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @if(isset($menu) && $menu->menu_id == null)
                            @lang('Menu:')  <a href="{{$menu->link}}" @if($menu->type == 'external_link') target="_blank" @endif >{{$menu->label}}</a> @isset($menu->icon->title) <div class="float-right"> <span class="{{$menu->icon->title}}"></span> </div> @endisset
                        @elseif(isset($menu) && isset($menu->menu_id))
                            @lang('Menu:')
                            @if(isset($menu->parent))
                                <a
                                href="{{$menu->parent->link}}"
                                @if($menu->parent->type == 'external_link')
                                    target="_blank"
                                @endif
                                >{{$menu->parent->label}}/</a>@endif<a
                                                                        href="{{$menu->link}}"
                                                                        @if($menu->type == 'external_link')
                                                                            target="_blank"
                                                                        @endif >{{$menu->label}}</a>

                                                                        @isset($menu->icon->title)
                                                                            <div class="float-right"> <span class="{{$menu->icon->title}}"></span> </div>
                                                                        @endisset
                        @else
                            @lang('Menus')
                        @endif
                    </x-slot>

                    <x-slot name="body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                               @if(isset($menu->id) && $menu->menu_id == null)
                                    <x-utils.link
                                        :text="__('Edit')"
                                        class="nav-link active"
                                        id="edit-menu-tab"
                                        data-toggle="pill"
                                        href="#edit-menu"
                                        role="tab"
                                        aria-controls="edit-menu"
                                        aria-selected="true" />

                                    <x-utils.link
                                        :text="__('View')"
                                        class="nav-link"
                                        id="view-the-menu-tab"
                                        data-toggle="pill"
                                        href="#view-the-menu"
                                        role="tab"
                                        aria-controls="view-the-menu"
                                        :aria-selected="false" />

                                    @if($menuHasHotlinks)
                                        <x-utils.link
                                            :text="__('Hotlinks')"
                                            class="nav-link"
                                            id="hotlink-menu-tab"
                                            data-toggle="pill"
                                            href="#hotlink-menus"
                                            role="tab"
                                            aria-controls="hotlink-menus"
                                            aria-selected="false" />
                                    @endif

                                    @if($menuHasItems)
                                        <x-utils.link
                                            :text="__('Items')"
                                            class="nav-link"
                                            id="items-tab"
                                            data-toggle="pill"
                                            href="#items"
                                            role="tab"
                                            aria-controls="items"
                                            aria-selected="false" />
                                    @endif

                                    <x-utils.link
                                        :text="__('All Menus')"
                                        class="nav-link"
                                        id="all-menus-tab"
                                        data-toggle="pill"
                                        href="#all-menus"
                                        role="tab"
                                        aria-controls="all-menus"
                                        :aria-selected="false"
                                    />
                                @elseif(isset($menu->id) && isset($menu->menu_id))
                                    <x-utils.link
                                        :text="__('Edit')"
                                        class="nav-link active"
                                        id="edit-link-tab"
                                        data-toggle="pill"
                                        href="#edit-link"
                                        role="tab"
                                        aria-controls="edit-link"
                                        aria-selected="true" />

                                        <x-utils.link
                                        :text="__('All Menus')"
                                        class="nav-link"
                                        id="all-menus-tab"
                                        data-toggle="pill"
                                        href="#all-menus"
                                        role="tab"
                                        aria-controls="all-menus"
                                        :aria-selected="false"
                                    />
                                @else

                                <x-utils.link
                                    :text="__('All Menus')"
                                    class="nav-link active"
                                    id="all-menus-tab"
                                    data-toggle="pill"
                                    href="#all-menus"
                                    role="tab"
                                    aria-controls="all-menus"
                                    aria-selected="true"
                                />

                                @endif

                                <x-utils.link
                                    :text="__('Office Menus')"
                                    class="nav-link"
                                    id="office-menus-tab"
                                    data-toggle="pill"
                                    href="#office-menus"
                                    role="tab"
                                    aria-controls="office-menus"
                                    aria-selected="false"/>

                                <x-utils.link
                                    :text="__('Admin Menus')"
                                    class="nav-link"
                                    id="admin-menus-tab"
                                    data-toggle="pill"
                                    href="#admin-menus"
                                    role="tab"
                                    aria-controls="admin-menus"
                                    aria-selected="false" />

                                <x-utils.link
                                    :text="__('New Menu')"
                                    class="nav-link"
                                    id="new-menu-tab"
                                    data-toggle="pill"
                                    href="#new-menu"
                                    role="tab"
                                    aria-controls="new-menu"
                                    aria-selected="false"/>

                                <x-utils.link
                                    :text="__('New Menu Item')"
                                    class="nav-link"
                                    id="menu-item-tab"
                                    data-toggle="pill"
                                    href="#menu-item"
                                    role="tab"
                                    aria-controls="menu-item"
                                    aria-selected="false"/>

                            </div>
                        </nav>
                        <div class="tab-content" id="menus-index-tabsContent">

                        @if(isset($menu->id) && $menu->menu_id == null)
                            <div class="tab-pane fade pt-3 show active" id="edit-menu" role="tabpanel" aria-labelledby="edit-menu-tab">
                                @include('frontend.menus.tabs.edit-menu', ['model' => $menu])
                            </div><!--tab-information-->

                            <div class="tab-pane fade pt-3" id="view-the-menu" role="tabpanel" aria-labelledby="view-the-menu-tab">
                                @include('frontend.menus.includes.grid.table', $menuGrid)
                            </div><!--tab-information-->

                            @if($menuHasHotlinks)
                                <div class="tab-pane fade pt-3" id="hotlink-menus" role="tabpanel" aria-labelledby="hotlink-menus-tab">
                                    <livewire:frontend.menus-table
                                        uniqueSeed='Alpha'
                                        group='all'
                                        withChildren=true
                                        :groupMeta=$hotlinksGroupMeta
                                    />
                                </div><!--tab-profile-->
                            @endif

                            @if($menuHasItems)
                                <div class="tab-pane fade pt-3" id="items" role="tabpanel" aria-labelledby="items-tab">
                                    <livewire:frontend.menus-table
                                        uniqueSeed='Beta'
                                        group='all'
                                        withChildren=true
                                        :groupMeta=$itemsGroupMeta
                                    />
                                </div><!--tab-profile-->
                            @endif

                        @elseif(isset($menu->id) && isset($menu->menu_id))
                            <div class="tab-pane fade pt-3 show active" id="edit-link" role="tabpanel" aria-labelledby="edit-link-tab">
                                @include('frontend.menus.tabs.edit-link', ['model' => $menu])
                            </div><!--tab-information-->
                        @endif

                            <div class="tab-pane fade pt-3 @if(!isset($menu->id)) show active @endif" id="all-menus" role="tabpanel" aria-labelledby="all-menus-tab">
                                <livewire:frontend.menus-table
                                    uniqueSeed='Gamma'
                                    group='all'
                                    withChildren=true
                                />
                            </div><!--tab-profile-->

                            <div class="tab-pane fade pt-3" id="office-menus" role="tabpanel" aria-labelledby="office-menus-tab">
                                <livewire:frontend.menus-table
                                    uniqueSeed='Delta'
                                    group='office'
                                    withChildren=true
                                />
                            </div><!--tab-information-->

                            <div class="tab-pane fade pt-3" id="admin-menus" role="tabpanel" aria-labelledby="admin-menus-tab">
                                <livewire:frontend.menus-table
                                    uniqueSeed='Epsilon'
                                    group='admin'
                                    withChildren=true
                                />
                            </div><!--tab-password-->

                            <div class="tab-pane fade pt-3" id="new-menu" role="tabpanel" aria-labelledby="new-menu-tab">
                                @include('frontend.menus.tabs.edit-menu')
                            </div><!--tab-information-->

                            <div class="tab-pane fade pt-3" id="menu-item" role="tabpanel" aria-labelledby="menu-item-tab">
                                @include('frontend.menus.tabs.edit-link', ['parent' => isset($menu->id) ? $menu : null])
                            </div><!--tab-information-->

                        </div><!--tab-content-->

                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
@push('after-scripts')

<link rel="stylesheet" href="{{asset('vendor/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css')}}" />
<script type="text/javascript"
    src="{{asset('vendor/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js')}}"></script>

@endpush
