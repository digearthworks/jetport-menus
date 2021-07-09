<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

    <x-jet-nav-link href="{{ route('admin.pages.deleted') }}" :active="request()->routeIs('admin.pages.deleted')">
        <svg class="w-6 h-6 pb-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>   {{__('Deleted Pages')}}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('admin.pages.deactivated') }}" :active="request()->routeIs('admin.pages.deactivated')">
        <svg class="w-6 h-6 pb-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>   {{__('Deactivated Pages')}}
    </x-jet-nav-link>

    <x-jet-nav-link  href="{{ route('admin.pages') }}" :active="request()->routeIs('admin.pages')">
        <svg class="w-6 h-6 pb-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>   {{__('Active Pages')}}
    </x-jet-nav-link>

    <x-jet-nav-link  href="{{ route('admin.pages.templates') }}" :active="request()->routeIs('admin.pages.templates')">
        <svg class="w-6 h-6 pb-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>   {{__('Templates')}}
    </x-jet-nav-link>

    @if(! str_contains(url()->current(), 'deactivated') && ! str_contains(url()->current(), 'deleted'))
        <x-jet-nav-link href="{{ route('admin.pages.create') }}" :active="request()->routeIs('admin.pages.create')" >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>   {{__('New Page')}}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('admin.pages.templates.create') }}" :active="request()->routeIs('admin.pages.templates.create')" >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>   {{__('New Template')}}
        </x-jet-nav-link>
    @endif
</div>
