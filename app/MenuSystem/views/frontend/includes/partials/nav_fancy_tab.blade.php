<li class="nav-item">
    <button class="fancyTab {!! config('seetings.fancy_tab_button_classes') !!}"
        onclick="window.open('{{url($link??'#')}}','{{$windName??'_self'}}{{isset($options)?','.$options:null}}');">{{$label??'No label'}}
    </button>
</li>