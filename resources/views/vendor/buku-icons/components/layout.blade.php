<x-html class="font-sans border-t-8 border-scarlet-500" :title="isset($title) ? $title . ' - ' . config('app.name') : ''">
    <x-slot name="head">

        <meta name="msapplication-TileColor" content="#b91d47">
        <meta name="theme-color" content="#ffffff">

        <script src="{{ mix('js/app.js','vendor/buku-icons') }}" defer></script>

        <link href="{{ mix('css/app.css','vendor/buku-icons') }}" rel="stylesheet">

        {{ $head ?? '' }}

        @livewireStyles
        @bukStyles

    </x-slot>

    {{ $slot }}

    @livewireScripts
    @bukScripts
</x-html>
