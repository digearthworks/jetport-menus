<a href="{{url('/menus/edit/'.$menu->id)}}">
    <i class="fa fa-edit text-dark" style="height:20px !important">
    </i>
</a>
<form id="delete-{{$menu->id}}" style="display:none" action="{{url('/menus/'.$menu->id)}}"
    method="POST">
    @method('DELETE') @csrf
</form>
<a href="#">

    <i class="fa fa-trash text-danger" onclick="
            if(confirm('delete link to {{$menu->link}}?')){
                document.getElementById('delete-{{$menu->id}}').submit();
            }" style="height:20px !important; display:inline-block;"></i>
</a>
<a href="{{url($menu->link)}}" @if(isset($menu->type) && $menu->type == 'external_link') target="_blank"  @endif >
    <i class="fa fa-eye text-primary" style="height:20px !important">
    </i>
</a>
