<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('frontend.menus.includes.header')
    @yield('head')
    @stack('head')
</head>

<body class="main-body">
    <!-- begin bootstrap4 navbar -->
    <div class="bstrap4-iso">
        <div class="top-bar">
            @include('frontend.menus.includes.navbar')
        </div>
        <!--end navbar -->
    </div>
    <div class="wrapper d-flex mouseable">
        <!-- sidebar wrapper -->
        @can(config('domains.auth.bookmarks_enabled')?'user.access.sidebar.bookmarks':'user.access.sidebar.office')
            @include('frontend.menus.includes.sidebar')
        @endcan
            <div class="content">
                @include('includes.partials.read-only')
                @include('includes.partials.logged-in-as')
                @include('includes.partials.messages')
                @include('includes.partials.announcements')
                @yield('main.content')
            </div>
        </div><!-- sidebar wrapper closes here -->
        @yield('before_scripts')
        @stack('before_scripts')
        <!-- Scripts -->
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        <livewire:scripts />
        @yield('after_scripts')
        @stack('after_scripts')
        <script>
            /*
                    |
                    | jquery is bundled into public/js/app.js see the
                    | boostrapping script in resources/js/app.js||
                    | resources/js/bootstrap.js
                    | https://api.jquery.com/
                    |
                    */
            $(document).ready(function() {
                /* |-------------------------------------------
                                        |https://plugins.jquery.com/slimScroll/
                                        |-------------------------------------------
                                        |
                                        |Add slim scroll to sidebar
                                    */
                var adjustSidebar = function() {
                    var scrollHeight = document.documentElement.clientHeight - $(".navbar").outerHeight()
                    console.log("scroll height: " + scrollHeight)
                    $(".sidebar").slimScroll({
                        height: scrollHeight,
                        alwaysVisible: false,
                        opacity: 0
                    }).mouseover(function() {
                        $(this).next('.slimScrollBar').css('opacity', 0.4);
                    });
                }
                /*
                |-------------------------------------------------------
                | https://www.w3schools.com/html/html5_webstorage.asp
                |-------------------------------------------------------
                |
                | Check if sidebar was expanded on last page visit
                | and if so, set up a function to click the
                | sideMenuToggler and reactivate it
                |
                */
                var checkSidebarState = function() {
                    console.log(localStorage.sidebarActive);

                    if (localStorage.sidebarActive == "on") {
                        $("#sideMenuToggler").click();
                    }

                    if (localStorage.settingsList == "on") {
                        $("#settingsToggler").click();
                    }

                    if (localStorage.officeList == "on") {
                        $("#officeToggler").click();
                    }

                    if (localStorage.databaseList == "on") {
                        $("#databaseToggler").click();
                    }

                    if (localStorage.bookmarksList == "on") {
                        $("#bookmarksToggler").click();
                    }
                    adjustSidebar();
                }
                var checkTopMenuState = function() {
                    console.log("topMenu: " + localStorage.topTabGroup);

                    switch (localStorage.topTabGroup) {
                        case ("topSettingsList"):
                            $("#openTopAdmin").click();
                            break
                        case ("topOfficeList"):
                            $("#openTopOffice").click();
                            break
                        default:
                            $("#homeHot").click();
                    }
                }
                /*
                |------------------------------------------
                |https://plugins.jquery.com/slimScroll/
                |------------------------------------------
                |
                | fire the slimscroll function
                */
                adjustSidebar();
                /*
                |-----------------------------------------
                |https://plugins.jquery.com/slimScroll/
                | ----------------------------------------
                |
                | fire the slimscroll function on window resize
                */
                $(window).resize(function() {
                    console.log('resize event fired')
                    adjustSidebar();
                });
                /*
                |---------------------------------
                | resources/scss/bootstrap.scss
                | --------------------------------
                |
                | Toggle sidebar on click
                */
                $(".sideMenuToggler").on("click", function() {
                    $(".wrapper").toggleClass("active").toggleClass("mouseable");

                    if ($(".wrapper").hasClass("active")) {

                        localStorage.setItem("sidebarActive", "on");
                    } else {
                        localStorage.setItem("sidebarActive", "off");
                    }
                });
                /*
                |---------------------------------
                | resources/scss/bootstrap.scss
                | --------------------------------
                |
                | Toggle sidebar on click
                */
                $("#settingsToggler").on("click", function() {
                    $("#settingsList").toggleClass("show");

                    if ($("#settingsList").hasClass("show")) {
                        localStorage.setItem("settingsList", "on");
                    } else {
                        localStorage.setItem("settingsList", "off");
                    }
                });

                $("#officeToggler").on("click", function() {
                    $("#officeList").toggleClass("show");

                    if ($("#officeList").hasClass("show")) {
                        localStorage.setItem("officeList", "on");
                    } else {
                        localStorage.setItem("officeList", "off");
                    }
                });

                $("#bookmarksToggler").on("click", function() {
                    $("#bookmarksList").toggleClass("show");

                    if ($("#bookmarksList").hasClass("show")) {
                        localStorage.setItem("bookmarksList", "on");
                    } else {
                        localStorage.setItem("bookmarksList", "off");
                    }
                });

                $("#databaseToggler").on("click", function() {
                    $("#databaseList").toggleClass("show");

                    if ($("#databaseList").hasClass("show")) {
                        localStorage.setItem("databaseList", "on");
                    } else {
                        localStorage.setItem("databaseList", "off");
                    }
                });

                $('#homeHot').on('click', function() {
                    $('#topOfficeList').removeClass('show');
                    $('#topSettingsList').removeClass('show');
                    $('#hotlist').toggleClass('show');
                    localStorage.setItem("topTabGroup", false);

                    if ($("#hotList").hasClass("show")) {
                        localStorage.setItem("topTabGroup", "hotList");
                    }

                });

                $('#openTopAdmin').on('click', function() {
                    $('#hotlist').removeClass('show');
                    $('#topOfficeList').removeClass('show');
                    $('#topSettingsList').toggleClass('show');
                    localStorage.setItem("topTabGroup", false);

                    if ($("#topSettingsList").hasClass("show")) {
                        localStorage.setItem("topTabGroup", "topSettingsList");
                    }

                });
                $('#openTopOffice').on('click', function() {
                    $('#topSettingsList').removeClass('show');
                    $('#hotlist').removeClass('show');
                    $('#topOfficeList').toggleClass('show');
                    localStorage.setItem("topTabGroup", false);

                    if ($("#topOfficeList").hasClass("show")) {
                        localStorage.setItem("topTabGroup", "topOfficeList");
                    }
                });
                /*
                |-------------------------------------------------------
                | https://www.w3schools.com/html/html5_webstorage.asp
                |------------------------------------------------------
                |  Fire our sidebar checker now that its
                |  dependencies are in place
                */
                checkTopMenuState();
                checkSidebarState();
                /*
                |-------------------------------
                |resources/scss/bootstrap.scss
                |-------------------------------
                |Toggle sidebar on hover
                |and give it a shadow
                |let it overlap page
                |
                */
                $(".sidebar").on("mouseenter", function() {
                    $(".wrapper").toggleClass("activated");
                });
                $(".sidebar").on("mouseleave", function() {
                    $(".wrapper").toggleClass("activated");
                });
                @yield('document_ready')
                @stack('document_ready')

            }); // end document ready function
            @yield('scripts')
            @stack('scripts')

        </script>
</body>
</html>
