<div {{ $attributes->merge(['class' => 'flex flex-wrap content-center p-2 overflow-hidden']) }} >
    {{ $slot ?? '' }}
</div>
