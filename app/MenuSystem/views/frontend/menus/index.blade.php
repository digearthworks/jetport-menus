@extends('frontend.layouts.app_menus')

@section('title', __('My Account'))
@push('head')
<link rel="stylesheet" href="/vendor/jquery-typeahead/dist/jquery.typeahead.min.css">
@endpush
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Menus Index')
                    </x-slot>

                    <x-slot name="body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach($menus as $menu)
                                    <x-utils.link
                                        :text="$menu->label"
                                        :class="$loop->first ? 'nav-link active' : 'nav-link'"
                                        :id="'menus-index-'.$menu->id.'-tab'"
                                        data-toggle="pill"
                                        :href="'#menus-index-'.$menu->id"
                                        role="tab"
                                        :aria-controls="'#menus-index-'.$menu->id"
                                        :aria-selected="$loop->first ? 'true' : 'false'" />
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="menus-index-tabsContent">

                            @foreach($menus as $menu)
                                <div class="tab-pane fade pt-3 @if($loop->first) show active @endif" id="menus-index-{{$menu->id}}" role="tabpanel" aria-labelledby="menus-index-{{$menu->id}}-tab">
                                    @include('frontend.menus.includes.grid.table', $menu->grid)
                                </div><!--tab-information-->
                            @endforeach

                        </div><!--tab-content-->

                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
@push('after-scripts')

<link rel="stylesheet" href="{{asset('vendor/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css')}}" />
<script type="text/javascript"
    src="{{asset('vendor/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js')}}"></script>

@endpush
