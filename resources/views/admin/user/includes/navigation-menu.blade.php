<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    <x-jet-nav-link href="{{ route('admin.users.deleted') }}" :active="request()->routeIs('admin.users.deleted')">
        {{__('Deleted')}}
    </x-jet-nav-link>
    <x-jet-nav-link href="{{ route('admin.users.deactivated') }}" :active="request()->routeIs('admin.users.deactivated')">
        {{__('Deactivated')}}
    </x-jet-nav-link>

    <x-jet-nav-link  href="{{ route('admin.users') }}" :active="request()->routeIs('admin.users')">
        {{__('All')}}
    </x-jet-nav-link>

    @if(! str_contains(url()->current(), 'deactivated') && ! str_contains(url()->current(), 'deleted'))
        <livewire:creates-user />
    @endif
</div>
