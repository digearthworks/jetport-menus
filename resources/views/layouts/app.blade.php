<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- icons -->
        {{-- <link href="{{ asset('vendor/icons/fontawesome-free/css/all.css') }}" rel="stylesheet"> --}}

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div x-data="{ open:false, sidebarOpen: '{{ session('sidebarOpen', config('turbine.menus.admin_sidebar_default_open', true )) }}', designerView: '{{ request()->has('designerView') ? 'true' : 'false' }}' }" class="flex min-h-screen overflow-x-hidden bg-gray-100">

            @if($logged_in_user->isAdmin())
                @livewire('turbine.menus.admin.admin-sidebar-menu')
            @endif
    
            <div class="flex-1">
    
                @if($logged_in_user->isAdmin())
                    @livewire('turbine.menus.admin.admin-navigation-menu')
                @else
                    @livewire('turbine.menus.navigation-menu')
                @endif
    
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
    
                        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
    
                    </header>
                @endif
    
                @include('admin.logged-in-as')
    
    
    
                <!-- Page Content -->
                <main>
    
                    {{ $slot }}
    
                </main>
            </div>
            @if($logged_in_user->isAdmin() || is_impersonating())
                @include('admin.designer-view-toggler')
            @endif
        </div>
    
        @stack('modals')
    
            @livewireScripts
            <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-clipboard@1.x.x/dist/alpine-clipboard.js"></script>
        </body>
</html>
