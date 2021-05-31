@props(['id'])

@php
$id = $id ?? md5($attributes->wire('model'));
@endphp
<div
    x-data="{
        show: @entangle($attributes->wire('model')).defer
    }"
>
    <button x-cloak x-show="show" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-10 h-10 mr-2 text-gray-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-gray-200']) }}>
        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
        {{ $slot }}
    </button>
</div>
