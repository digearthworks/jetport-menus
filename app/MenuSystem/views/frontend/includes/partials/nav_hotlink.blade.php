<li class="nav-item pl-1">
    <div
        class="tabButton pl-1 pr-1 {!! config('settings.hotlink_tab_bootstrap4_classes') !!} {!! $user_hotlink_styles !!}">
        <a href="{{url($menu_url??'#')}}"
            {{-- style="font-family: Arial; font-size: 12px; font-weight: normal; color: #00a3c4; text-decoration: none;" --}}
            style="font-family: Arial; font-size: 12px; font-weight: normal; color: white; text-decoration: none;"
            >
            <span
                class="{!! $user_icon_styles !!}">
                {{$label??'No label'}}
            </span>
            <i class="far fa-caret-square-down {!! $user_icon_styles !!}"
                title="{{$title??''}}"> </i>
        </a>
        <div style="text-align: center ; ">
            @isset($hotlinks)
                @foreach($hotlinks as $hotlink)
                    @isset($hotlink->permission->name)
                        @can($hotlink->permission->name)
                            <a
                                class="xbtn"
                                href="{{url($hotlink->link)}}"
                                title="{{$hotlink->title}}"
                                @if(isset($field->type) && $field->type == 'external_link')target="_blank"@endif
                                ><i
                                    class="{!! $hotlink->icon->title??'fa fa-question' !!} icon-sm {!! $user_icon_styles !!}"></i></a>
                        @endcan
                    @else
                        <a
                            class="xbtn"
                            href="{{url($hotlink->link)}}"
                            title="{{$hotlink->title}}"
                            @if(isset($field->type) && $field->type == 'external_link')target="_blank"@endif
                            ><i
                                class="{!! $hotlink->icon->title??'fa fa-question' !!} icon-sm {!! $user_icon_styles !!}"></i></a>
                    @endisset
                @endforeach
            @endisset
        </div>
    </div>
</li>
