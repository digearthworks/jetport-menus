<div {{ $attributes->merge(['class' => 'grid grid-cols-24 gap-0 p-2']) }} >
    {{ $slot ?? '' }}
</div>
