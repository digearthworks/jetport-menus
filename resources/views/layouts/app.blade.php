<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div x-data="{ open:false, sidebarOpen: false }" class="flex overflow-x-hidden min-h-screen bg-gray-100">
        <aside class="flex-shrink-0 w-52 flex flex-col border-r transition-all duration-300" x-show="sidebarOpen"
            {{-- :class="{ '-ml-40': !sidebarOpen }" --}}
            >

            <nav class="flex-1 flex flex-col bg-white border-l border-gray-100">
                <a href="#" class="p-2">Nav Link 1</a>
                <a href="#" class="p-2">Nav Link 2</a>
                <a href="#" class="p-2">Nav Link 3</a>
            </nav>
        </aside>
        <div class="flex-1">
            @livewire('navigation-menu')
            {{-- @include('navigation-menu') --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}

            </main>
        </div>
    </div>
    @stack('modals')

    @livewireScripts
</body>

</html>
