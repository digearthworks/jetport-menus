<aside class="flex-shrink-0 w-48 flex flex-col border-r transition-all duration-300" x-show="sidebarOpen">
    <nav class="flex-1 flex flex-col bg-white border-l border-gray-100">

        @foreach($navItems as $navItem)
            <a href="#" class="px-2 text-gray-600">{{$navItem}}</a>
        @endforeach

    </nav>
</aside>
