<figure style="height:130px !important" onclick="{!! $onclick??'' !!}" class=" icon-info mx-1">
    <a onclick="{!! $aOnclick??'' !!}" class="context-menu-one" href="{{url($link??'#')}}"><img
            style="margin-left:1px !important;" src="{{asset($src??'storage/drawing.svg')}}" width="{{$width??'90'}}"
            height="{{$height??'120'}}">
    </a>
    <span>
        {{$label??''}}
    </span>
</figure>
