<div class="sideMenu bg-white">
    <div class="bstrap4-iso">
        <div class="sidebar {!! config('ui.sidebar_bootstrap4_classes') !!} {!! $user_sidebar_styles !!}">
            <ul style="list-style-type: none;" id="#accParent" class="navbar-nav">
                @if(config('domains.auth.bookmarks_enabled'))
                    @can( 'user.access.sidebar.bookmarks')
                        <li style="list-style-type: none;" class="nav-item">
                            <a class="nav-link" id="bookmarksToggler" href="#bookmarksList" data-target="#collapseListGroup1"
                                data-toggle="collapse" aria-expanded="false" aria-controls="bookmarksList">
                                <i class="icon material-icons {!! $user_icon_styles !!}">
                                    bookmarks
                                </i>
                                <span class="text {!! $user_icon_styles !!}">
                                    Bookmarks
                                </span>
                            </a>
                            <ul style="list-style-type: none;" class="nav-item ml-0">
                                <div id="bookmarksList" class="collapse">

                                </div>
                            </ul>
                        </li>
                    @endcan
                @endif
                @can('admin.access.sidebar.admin')
                    <li style="list-style-type: none;" class="nav-item">
                        <a class="nav-link" id="settingsToggler" href="#settingsList" data-target="#collapseListGroup1"
                            data-toggle="collapse" aria-expanded="false" aria-controls="settingsList">
                            <i class="icon material-icons {!! $user_icon_styles !!}">
                                settings
                            </i>
                            <span class="text {!! $user_icon_styles !!}">
                                admin
                            </span>
                        </a>
                        <ul style="list-style-type: none;" class="nav-item ml-0">
                            <div id="settingsList" class="collapse">
                                @foreach ($admin_menus as $admin_menu)
                                    @can(isset($admin_menu->permission->name) ? $admin_menu->permission->name : 'admin.access.sidebar.admin')
                                        @include('frontend.includes.partials.nav_item_link',['field' => $admin_menu])
                                    @endcan
                                @endforeach
                            </div>
                        </ul>
                    </li>
                @endcan
                @can('user.access.sidebar.office')
                <li class="nav-item">
                    <a class="nav-link" id="officeToggler" href="#officeList" data-target="#collapseListGroup1"
                        data-toggle="collapse" aria-expanded="false" aria-controls="officeList">
                        <i class="icon material-icons {!! $user_icon_styles !!}">
                            cloud
                        </i>
                        <span class="text {!! $user_icon_styles !!}">
                            Office
                        </span>
                    </a>
                    <div id="officeList" class="collapse">
                        <ul style="list-style-type: none;" class="nav-item ml-0">
                            @foreach ($office_menus as $office_menu)
                                @can(isset($office_menu->permission->name) ? $office_menu->permission->name : 'admin.access.sidebar.office')
                                    @include('frontend.includes.partials.nav_item_link',['field' => $office_menu])
                                @endcan
                            @endforeach
                        </ul>
                    </div>
                </li>
                @endcan
                @can('admin.access.database.ui')
                    <li class="nav-item">
                        <a class="nav-link" id="databaseToggler" href="#databaseList" data-target="#collapseListGroup1"
                            data-toggle="collapse" aria-expanded="false" aria-controls="databaseList">
                            <i class="icon fas fa-database {!! $user_icon_styles !!}"></i>
                            <span class="text  {!! $user_icon_styles !!}">
                                Database ({{ config('database.default', 'sqlite') }})
                            </span>
                        </a>
                        <div id="databaseList" class="collapse">
                            <ul style="list-style-type: none;" class="nav-item ml-0">
                                @foreach ($database_tables as $table)
                                    @include('frontend.includes.partials.nav_item_link',[
                                    'icon' => 'icon fa fa-table',
                                    'label' => $table,
                                    'field' => null,
                                    'link' => '/'.config('ui.internal_iframe_prefix').'/qwoffice/sq_table_field_list?q='.$table
                                    ])
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
    <!-- end bootstrap4  styles -->
</div>
