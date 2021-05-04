<li class="nav-item" id="{{$id??''}}">
    <a href="{{isset($field)?$field->link??$link??'#':$link??'#'}}" @if(isset($field->type) && $field->type == 'external_link') target="_blank"  @endif class="nav-link">
        <i class="icon {!! isset($field)?$field->icon?$field->icon->title??'fa fa-question':$icon??'fa fa-question':$icon??'fa fa-question' !!} {!! $user_icon_styles !!}"
            style="height:20px !important">
        </i>
        <span
            class="text {!! $user_icon_styles !!}">
            {{isset($field)?$field->label??$label??'':$label??''}}
        </span>
    </a>
</li>
