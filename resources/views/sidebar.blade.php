<aside class="flex-shrink-0 w-48 flex flex-col border-r transition-all duration-300" x-show="sidebarOpen">

    <div class="flex justify-between h-16 bg-white border-b border-gray-100">
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
                      <a href="http://127.0.0.1:8000/dashboard">
                          <img width="50" height="50" class="mx-16"  src="http://127.0.0.1:8000/stock-img/qwo_logo.png">
                      </a>
          </div>
        </div>
        </div>

    <nav class="pt-8 flex-1 flex flex-col bg-white border-l border-gray-100">

        @foreach($navItems as $navItem)
            <a href="#" class="px-2 text-gray-600">{{$navItem}}</a>
        @endforeach

    </nav>
</aside>
