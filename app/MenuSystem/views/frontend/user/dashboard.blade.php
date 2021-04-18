@extends('frontend.layouts.menus')

@section('title', __('Dashboard'))

@section('main.content')
{{-- <div id="app">
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam voluptate quibusdam soluta dolores reiciendis enim,
    nisi
    laudantium omnis sequi saepe corporis, beatae sapiente architecto rem ipsa recusandae. Earum, iste temporibus!
    <example-component></example-component>
</div> --}}
@mobile
@else
<div class="bstrap4-iso" style="width:100%; height: 93vh;">
    <div class="w-100 h-100"
        style="background-image:url({{asset(Auth::user()->settings['background_img']??Auth::user()->background_img??config('ui.default_background','storage/stock-images/drawing.svg'))}}); background-repeat: no-repeat; background-size: 100% 100%">

    </div>

</div>
@endmobile
@endsection
