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

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body style="background-image: url('{{ isset ($app_logo) ? asset($app_logo) : asset(config('ui.logo', 'stock-img/qwo_logo.png'))}}'" class="antialiased bg-no-repeat bg-cover">
        <div class="fixed top-0 left-0 hidden px-6 py-4 sm:block">
            <div class="flex items-center flex-shrink-0">
                <a href="{{ route('index') }}">
                    <x-jet-application-mark class="block w-auto h-9" />
                </a>
            </div>
        </div>
        <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
            @if(config('template.cms.cms'))
                @foreach($topPages as $page)
                    <x-jet-nav-link  href="/pages/{{ $page->slug }}" :active="currentRouteHas($page->slug)">
                        {{__(':title', [ 'title' => \Str::of($page->slug)->replace(['_', '-'], ' ')->title() ])}}
                    </x-jet-nav-link>
                @endforeach
            @endif
            @if (Route::has('login'))
                @auth
                    <x-jet-nav-link href="{{ url('/dashboard') }}" >Dashboard</x-jet-nav-link>
                @else
                    <x-jet-nav-link href="{{ route('login') }}">Log in</x-jet-nav-link>

                    @if (Route::has('register'))
                        <x-jet-nav-link href="{{ route('register') }}">Register</x-jet-nav-link>
                    @endif
                @endauth
            @endif
        </div>
        <div class="font-sans antialiased text-gray-900">
            {{ $slot }}
        </div>
    </body>
</html>
