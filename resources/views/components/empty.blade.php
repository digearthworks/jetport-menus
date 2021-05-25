<blockquote {{ $attributes->merge(['class' => 'flex items-center ml-3 text-sm text-gray-700']) }}>
    <svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <span class="ml-1">
        {{ $slot }}
    </span>
</blockquote>
