<div class="bstrap4-iso">
<div x-data="{showChildren: false}"
>

    <div class="alert alert-white shadow-sm">

        <h5 class="text-secondary">
           <a href="{{$menu->link}}"> <i class="{!! $menu->icon->title??'' !!}" style="height:20px !important"></i> {{$menu->label}}</a>
           <small>
            {{$menu->title}}
           </small>
            @can('admin.access.hidden.menu-grids')
            <ul class="nav float-right">

                <li class="nav-item">
                    <a x-on:click="showChildren = !showChildren"
                       onclick="this.firstElementChild.classList.toggle('fa-folder');this.firstElementChild.classList.toggle('fa-folder-open')"
                    class="btn shadow-sm">
                        <i class="fa fa-folder" id="showChildrenFolder" style="height:20px !important">
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn alert-warning" href="{{url('/menus/edit/'.$menu->id)}}">
                        <i class="fa fa-edit" style="height:20px !important">
                        </i>
                    </a>
                </li>

                <li class="nav-item">
                    <form id="delete-{{$menu->id}}" style="display:none" action="{{url('/menus/'.$menu->id)}}"
                        method="POST">
                        @method('DELETE') @csrf
                    </form>
                    <a class="btn alert-danger" href="#">
                        <i class="fa fa-trash" onclick="
                    if(confirm('Delete menu?')){
                        document.getElementById('delete-{{$menu->id}}').submit();
                    }" style="height:20px !important; display:inline-block;"></i>
                    </a>
                </li>
            </ul>
            @endcan
        </h5>
    </div>
    <div x-show="showChildren"
    >
    <livewire:frontend.menus-table
    uniqueSeed='Zeta'
    group='all'
    withChildren=true
    :groupMeta=$itemsGroupMeta
    :searchEnabled=false
    :paginationEnabled=false
/>
    </div>
</div>
    {{-- <small> {{$menu->title}} </small> --}}
    <div class="alert alert-white shadow-sm">
        <table border='0' cellspacing='2' cellpadding='2' style='margin-left: 10px; border-collapse: collapse'>
            @foreach($rows as $row)
            <tr>
                @foreach($row as $itemInRow)
                {{-- @can($itemInRow->permissions??'admin.access.sidebar.office') --}}
                <td>
                    @include('frontend.includes.partials.figure', ['item' => $itemInRow])

                </td>
                {{-- @endcan --}}
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
</div>
