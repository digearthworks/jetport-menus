<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    @can ('admin.access.user')
        <x-jet-nav-link href="{{ route('admin.users.deleted') }}" :active="request()->routeIs('admin.users.deleted')">
            <svg class="w-6 h-6 pb-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>   {{__('Deleted')}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('admin.users.deactivated') }}" :active="request()->routeIs('admin.users.deactivated')">
            <svg class="w-6 h-6 pb-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>   {{__('Deactivated')}}
        </x-jet-nav-link>

        <x-jet-nav-link  href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
            <svg class="w-6 h-6 pb-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>   {{__('Active')}}
        </x-jet-nav-link>
    @endif

    @if(! str_contains(url()->current(), 'deactivated') && ! str_contains(url()->current(), 'deleted'))
        <livewire:create-user-button />
    @endif
</div>
