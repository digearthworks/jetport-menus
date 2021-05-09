<aside class="flex flex-col flex-shrink-0 w-48 transition-all duration-300 border-r" x-show="sidebarOpen">

    <div class="flex justify-between h-16 bg-white border-b border-gray-100">
        <div class="flex">
            <div class="flex items-center flex-shrink-0 mx-16">
                <a href="{{ route('dashboard') }}">
                    <x-jet-application-mark class="block w-auto h-9" />
                </a>
            </div>
        </div>
    </div>

    <nav class="flex flex-col flex-1 pt-8 bg-white">

        <div class="ml-0" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-2 py-3 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <span class="flex items-center">
                    <svg class="h-6 pl-0 ml-0w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>

                    <span class="mx-2 font-medium">Admin</span>
                </span>

                <span>
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                        <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </button>
            <div x-show="open" class="ml-4">
                @foreach($adminItems as $adminItem)
                    <a class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="{{ $adminItem->link }}"><span class="pr-1">{!! $adminItem->icon->art !!}</span>{{$adminItem->label}}</a>
                @endforeach
            </div>
        </div>

        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full px-2 py-3 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <span class="flex items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z">
                        </path>
                    </svg>

                    <span class="mx-2 font-medium">Office</span>
                </span>

                <span>
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                        <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </button>

            <div x-show="open" class="ml-8">
                @foreach ($officeItems as $officeItem)
                    <a class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="{{ $adminItem->link }}"><span class="pr-1">{!! $adminItem->icon->art !!}</span>{{$adminItem->label}}</a>
                @endforeach
            </div>
        </div>

        @if($logged_in_user->isMasterAdmin())
            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-2 py-3 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                    <span class="flex items-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>

                        <span class="mx-2 font-medium">Logs</span>
                    </span>

                    <span>
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                            <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </button>

                <div x-show="open" class="ml-8">

                        <a class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="/admin/log-viewer"><span class="pr-1"></span>Dashboard</a>
                        <a class="flex items-center px-4 py-2 text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="/admin/log-viewer/logs"><span class="pr-1"></span>Logs</a>

                </div>
            </div>
        @endif

    </nav>
</aside>
