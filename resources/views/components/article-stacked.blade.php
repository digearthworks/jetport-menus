<a {{ $attributes->merge(['class' => 'w-full overflow-hidden sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/6 text-gray-500 bg-white cursor-pointer hover:text-gray-900 hover:bg-gray-50 focus:bg-gray-50']) }}>

    <div class="flex flex-row w-full">
        {{ $slot ?? '' }}
    </div>
    <div class="flex flex-row w-full h-8">
        {{ $caption ?? '' }}
    </div>
</a>
