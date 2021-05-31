@props(['id'])

@php
$id = $id ?? md5($attributes->wire('model'));
@endphp
<div
    x-data="{
        show: @entangle($attributes->wire('model')).defer
    }"
>
<button x-cloak x-show="show" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-10 h-10 mr-2 text-red-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-gray-200']) }}>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
    {{ $slot }}
</button>
</div>
