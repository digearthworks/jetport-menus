<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

    <x-jet-nav-link href="{{ route('admin.icons.grid') }}" :active="request()->routeIs('admin.icons.grid')">
        <i class="text-lg fas fa-icons"></i>   <span class="ml-0.5">{{__('Icon Grid')}}</span>
    </x-jet-nav-link>

    <x-jet-nav-link  href="{{ route('admin.icons') }}" :active="request()->routeIs('admin.icons')">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg> {{__('Icon Table')}}
    </x-jet-nav-link>

    @if(! str_contains(url()->current(), 'deactivated') && ! str_contains(url()->current(), 'deleted'))
        <livewire:admin.icons.create-icon-button value="New Icon" />
    @endif
</div>
