@if($menu->menu_id)
<div class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100"><i class="fa fa-link"></i></div>
@elseif($menu->children()->exists())
<div
    class="px-4 py-2 font-semibold text-gray-800 bg-white border border-gray-400 rounded shadow hover:bg-gray-100"
    onclick="this.firstElementChild.classList.toggle('fa-folder');this.firstElementChild.classList.toggle('fa-folder-open')"
    ><i class="fa fa-folder"></i></div>
@endif
