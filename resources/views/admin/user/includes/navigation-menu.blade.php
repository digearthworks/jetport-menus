<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-jet-nav-link href="/admin/auth/users/deleted" :active="str_contains(url()->current(), 'deleted')">
        {{__('Deleted')}}
    </x-jet-nav-link>
    <x-jet-nav-link href="/admin/auth/users/deactivated" :active="str_contains(url()->current(), 'deactivated')">
        {{__('Deactivated')}}
    </x-jet-nav-link>

    <x-jet-nav-link href="/admin/auth/users" :active="! str_contains(url()->current(), 'deactivated') && ! str_contains(url()->current(), 'deleted')">
        {{__('All')}}
    </x-jet-nav-link>

    @if(! str_contains(url()->current(), 'deactivated') && ! str_contains(url()->current(), 'deleted'))
        <livewire:creates-user />
    @endif
</div>
