<div {{ $attributes->merge(['class' => 'flex items-center text-sm']) }}>
    <svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    <span class="ml-1">
        {{ $slot }}
    </span>
</div>
