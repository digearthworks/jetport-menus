<aside class="flex-shrink-0 w-48 flex flex-col border-r transition-all duration-300" x-show="sidebarOpen">

    <div class="flex justify-between h-16 bg-white border-b border-gray-100">
        <div class="flex">
            <div class="flex-shrink-0 flex mx-16 items-center">
                <a href="{{ route('dashboard') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>
        </div>
    </div>

    <nav class="pt-8 flex-1 flex flex-col bg-white">

        <div class="ml-0" x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full flex justify-between items-center py-3 px-2 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <span class="flex items-center">
                    <svg class=" pl-0 ml-0w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
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
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                        <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </button>
{{-- {{ $adminItems}} --}}
            <div x-show="open" class="ml-4">
                @foreach($adminItems as $adminItem)
                    @isset($adminItem->icon->svg)
                    <a class="py-2 px-4 flex items-center text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="{{ $adminItem->link }}"><span class="pr-1">{!!$adminItem->icon->svg!!}</span> {{$adminItem->label}}</a>

                    @else
                        <a class="py-2 px-4 flex items-center text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="#"><span class="{{ $adminItem->icon->title }} pr-1"></span> {{ $adminItem->label }}</a>
                    @endisset
                @endforeach
            </div>
        </div>

        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full flex justify-between items-center py-3 px-2 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
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
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                        <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </button>

            <div x-show="open" class="ml-8">
                {{-- @foreach ($officeItems as $officeItem)
                    <a class="py-2 px-4 block text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="#">{{ $officeItem }}</a>
                @endforeach --}}
            </div>
        </div>

    </nav>
</aside>
