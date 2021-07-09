<aside class="fixed flex flex-col flex-shrink-0 w-48 h-screen transition-all duration-300 sm:relative" x-show="sidebarOpen">

    <div class="flex items-center justify-around h-16 bg-white border-b border-gray-100">
        <div>
            @livewire('turbine.menus.admin.admin-sidebar-toggler')
        </div>
        <div class="flex items-center flex-shrink-0">
        <a href="{{ route('dashboard') }}">
            <x-jet-application-mark class="block w-auto h-9" />
        </a>
        </div>
    </div>

    <nav class="flex flex-col flex-1 pt-8 bg-white border-r border-gray-100">
        @foreach($menus as $menu)
            <x-accordion-dropdown
                :menu="$menu"
                :menuOpen="$menuOpen"
            >
            <x-slot name="header">
                <h1 class="text-lg text-indigo-700">
                    {{ $menu->name }}
                </h1>
            </x-slot>
            </x-accordion-dropdown>
        @endforeach
    </nav>
</aside>
