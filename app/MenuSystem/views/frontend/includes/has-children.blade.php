@if($withChildren)
    @if($menu->menu_id)
    <div class="btn-sm"><i class="fa fa-link"></i></div>
    @elseif($menu->children()->exists())
    <div
        class="btn btn-sm btn-light shadow-sm"
        onclick="this.firstElementChild.classList.toggle('fa-folder');this.firstElementChild.classList.toggle('fa-folder-open')"
        ><i class="fa fa-folder"></i></div>
    @endif
@endif
