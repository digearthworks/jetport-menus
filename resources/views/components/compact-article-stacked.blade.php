<a {{ $attributes->merge(['class' => 'border border-gray-100 rounded-md text-gray-500 bg-white cursor-pointer hover:text-gray-900']) }}>

    <div class="flex flex-row w-full">
        {{ $slot ?? '' }}
    </div>

    @isset($caption)
        <div class="flex flex-row w-full h-8 pt-2">
            {{ $caption ?? '' }}
        </div>
    @endisset
</a>
