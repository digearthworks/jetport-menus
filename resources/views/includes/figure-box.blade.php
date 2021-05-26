<div>

    <figure class="border-white border-l border-r border-t border-b float-left"
    style=" background: #f4f4f4;width: 104px; height: 104px; border-radius: 5px; box-shadow: 0 1px 1px #d6d6d6; margin: 0 0 12px 6px; position: relative"
    onmouseover="this.style.background='#fff'"
    onmouseout="this.style.background='#f4f4f4'"
    >
    <a class="context-menu-one"
    id="{{$item->id??$id??''}}"
    href="{{$item->link??$link??'#'}}"
    @if(isset($item->type) && $item->type == 'external_link') target="_blank"  @endif
    title="{{$item->title??$title??'untitled'}}"
    >
    <i  style="margin-left: 13px; margin-top: 9px; font-size: 70px !important; color: #878d8d;"
    onmouseover="this.style.color='#ec6271'"
    onmouseout="this.style.color='#878d8d'"
    class="menu-i {!! $item->icon->title??$icon??'fa fa-question' !!}"></i>
</a>
<span style="position: absolute; top: 82px; width: 92px; text-align: center; left: 1px; overflow: hidden; height: 18px; font-size: 17px; line-height: 20px"
>{{$item->label??$label??'no label'}}</span>
</figure>

</div>
