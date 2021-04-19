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
        <link href="{{ asset('css/icons/font-awesome/css/all.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>

    <body class="font-sans antialiased">

    <div x-data="{ open:false, sidebarOpen: false }" class="flex overflow-x-hidden min-h-screen bg-gray-100">

        @livewire('sidebar')

        <div class="flex-1">

            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">

                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>

                </header>
            @endif

            @include('includes.logged-in-as')

            <x-jet-banner />

            <!-- Page Content -->
            <main>

                {{ $slot }}

            </main>
        </div>

    </div>

    @stack('modals')

        @stack('modals')

        @livewireScripts
    </body>
</html>
