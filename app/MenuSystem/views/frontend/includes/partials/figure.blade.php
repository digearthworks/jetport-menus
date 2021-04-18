<figure
    class="icon-info mx-1"><a
                                class="context-menu-one"
                                id="{{$item->id??$id??''}}"
                                href="{{$item->link??$link??'#'}}"
                                @if(isset($item->type) && $item->type == 'external_link') target="_blank"  @endif
                                title="{{$item->title??$title??'untitled'}}"><i
                                                                                {{-- style="margin-left: 16px !important;
                                                                                        margin-top: 4px !important;
                                                                                        font-size: 70px !important" --}}
                                                                                class="menu-i {!! $item->icon->title??$icon??'fa fa-question' !!}"></i></a><span>{{$item->label??$label??'no label'}}</span>
</figure>
