@extends('frontend.layouts.menus')

@section('head')
@stack('before-styles')
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <livewire:styles />
    @stack('after-styles')

@endsection

@section('main.content')

    <div id="app">
        <div class="bstrap4-iso">
            {{-- @include('includes.partials.messages') --}}

            <main>
                    @yield('content')
            </main>
        </div>
    </div>
    <!--app-->
    @endsection

    @push('before_scripts')
        @stack('before-scripts')
    @endpush
    @push('after_scripts')
        @stack('after-scripts')
    @endpush
