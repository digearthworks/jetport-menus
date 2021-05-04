<nav style="{!! config('ui.navbar_inline_styles') !!}"
class="navbar navbar-expand-xl fixed-top shadow-sm p-0 m-0 {!! $user_navbar_styles !!} ">

@can(config('domains.auth.bookmarks_enabled')?'user.access.sidebar.bookmarks':'user.access.sidebar.office')
<a href="#" id="sideMenuToggler" class="ml-0 p-0 nav-link sideMenuToggler">
    <i style="color:gray" class="icon material-icons">
        menu_open
    </i>
</a>
@endcan

<a class="navbar-brand" href="{{url('/dashboard')}}">
    <img class="logo-quick-nav"
        src='{{asset(config('ui.logo','https://quickweboffice.com/static/logo_qwo.png'))}}'>
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <i style="color:gray" class="icon material-icons">
        menu
    </i>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">


    <div class="collapse navbar-collapse">

        <div class="collapse" id="hotlist">
            <ul class="navbar-nav mr-auto align-items-end">
                @foreach($hotlink_menus as $hotlink_menu)
                    @if(isset($hotlink_menu->hotlinks) && count($hotlink_menu->hotlinks) > 0)
                        @include('frontend.includes.partials.nav_hotlink', [
                            'menu_url' => $hotlink_menu->link,
                            'label' => $hotlink_menu->label,
                            'title' => $hotlink_menu->title,
                            'hotlinks' => $hotlink_menu->hotlinks
                        ])
                    @else
                        @isset($hotlink_menu->permission)
                            @can($hotlink_menu->permission->name)
                            <a
                                class="nav-item px-1"
                                href="{{url($hotlink_menu->link)}}"
                                title="{{$hotlink_menu->title}}"
                                @if(isset($hotlink_menu->type) && $hotlink_menu->type == 'external_link')target="_blank"@endif
                            ><i
                                class="{!! isset($hotlink_menu->icon->title) ? $hotlink_menu->icon->title : 'fa fa-question' !!} icon-sm {!! $user_icon_styles !!}"></i></a>
                            @endcan
                        @else
                            <a
                                class="nav-item px-1"
                                href="{{url($hotlink_menu->link)}}"
                                title="{{$hotlink_menu->title}}"
                                @if(isset($hotlink_menu->type) && $hotlink_menu->type == 'external_link')target="_blank"@endif
                            ><i
                                class="{!! isset($hotlink_menu->icon->title) ? $hotlink_menu->icon->title : 'fa fa-question' !!} icon-sm {!! $user_icon_styles !!}"></i></a>
                        @endisset
                    @endif
                @endforeach
            </ul>
        </div>
        @if($is_admin)
        <div class="collapse" id="topSettingsList">
            <ul class="navbar-nav nav-tabs mr-auto align-items-end">

                @foreach ($admin_menus as $admin_menu)
                    @can(isset($admin_menu->permission->name) ? $admin_menu->permission->name : 'admin.access.hidden.navbar')
                        @include('frontend.includes.partials.nav_fancy_tab',[
                            'link' => $admin_menu->link,
                            'label' =>$admin_menu->label
                        ])
                    @endcan
                @endforeach

            </ul>
        </div>
        @endif
        <div class="collapse" id="topOfficeList">
            <ul class="navbar-nav nav-tabs mr-auto align-items-end">

                @foreach ($office_menus as $office_menu)
                    @can(isset($office_menu->permission->name) ? $office_menu->permission->name : 'admin.access.sidebar.office')
                        @include('frontend.includes.partials.nav_fancy_tab',[
                            'link' => $office_menu->path(),
                            'label' =>$office_menu->label
                        ])
                    @endcan
                @endforeach

            </ul>
        </div>

        <ul class="navbar-nav ml-auto mt-0 p-0">

            @can('user.access.finacials.edit')
            <li class="nav-item  p-0 m-0">
                <a href="https://louis.inman.network/" target="_blank" class="nav-link p-0 m-0">
                    <i
                        class="icon material-icons {!! $user_icon_styles !!} p-0 m-0">
                        folder
                    </i>
                </a>
            </li>
            @endcan


            <li class="nav-item  p-0 m-0">
                <a id="homeHot" href="#" class="nav-link p-0 m-0">
                    <i
                        class="icon material-icons {!! $user_icon_styles !!} p-0 m-0">
                        home
                    </i>
                </a>
            </li>
            <li class="nav-item p-0  m-0">
                <a href="#" id="openTopOffice" class="nav-link  p-0 m-0">
                    <i
                        class="icon material-icons {!! $user_icon_styles !!} p-0 m-0">
                        cloud
                    </i>
                </a>
            </li>
            @if($is_admin)
            <li class="nav-item p-0 m-0">
                <a id="openTopAdmin" href="#" class="nav-link p-0 m-0">
                    <i
                        class="icon material-icons {!! $user_icon_styles !!} p-0 m-0">
                        settings
                    </i>
                </a>
            </li>
            @endif
        </ul>
    </div>
    <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <img class="rounded-circle" style="max-height: 20px" src="{{ $logged_in_user->avatar }}" />
                <span
                    class="{!! $user_icon_styles !!}">
                    {{ $full_name }} </span> <span
                    class="caret {!! $user_icon_styles !!}"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right customClassForDropDown"
                aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('frontend.auth.logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                @if ($logged_in_user->isAdmin())
                <x-utils.link
                    :href="route('admin.dashboard')"
                    :text="__('Administration')"
                    class="dropdown-item" />
                @endif
                <a class="dropdown-item" href="{{ route('frontend.user.account') }}">
                    @lang('Account')
                </a>
                <a class=" dropdown-item" onclick="
                window.open('https://rainloop.inman.network')" href="#">
                     <i class="fas fa-envelope"></i> Email
                 </a>
                <a class=" dropdown-item"
                    onclick="
                window.open('{{config('ui.default_bug_reporter',
                'https://gitreports.com/issue/inmanturbo/quickweb-laravel')}}','window','toolbar=no,menubar=no, resizable=yes,scrollbars=no,location=no,directories=no,status=no,height=850,width=600');"
                    href="#">
                    <i class="fas fa-bug"></i> Report a bug
                </a>
                <hr>
                @can('admin.access.hidden.navbar')
                <a class=" dropdown-item" onclick="
                window.open('{{
                config('ui.default_code_source',
                'https://github.com/login?return_to=%2Finmanturbo%2Fquickweb-laravel')
                }}','_blank');" href="#">
                    <i class="fab fa-github"></i> Source code <br />
                </a>
                <a class=" dropdown-item" onclick="
                window.open('{{
                config('ui.default_code_source',
                'https://github.com/login?return_to=%2Finmanturbo%2Fquickweb-laravel%2Fissues')
                }}','_blank');" href="#">
                    <i class="fas fa-tasks"></i> Track issues <br />
                    <small>& request features</small> <br />
                </a>
                @endcan
                @foreach($hotlink_menus as $hotlink_menu)
                <a class=" dropdown-item" href="{{$hotlink_menu->link}}">
                    <i class="{{$hotlink_menu->icon->title??''}}"></i> {{$hotlink_menu->label}}
                </a>
                @endforeach
                <form id='logout-form' action=" {{ route('frontend.auth.logout') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>
</div>

</nav>
