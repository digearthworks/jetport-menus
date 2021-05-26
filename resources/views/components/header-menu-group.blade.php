<x-header-nav-group :active="$active ?? false">
    <div class="flex flex-col p-0">
        <div class="flex flex-row items-center justify-around -mb-0.5">
            {{ $header }}
        </div>
        <div class="flex flex-row items-center justify-evenly">
            {{ $slot }}
        </div>
    </div>
</x-header-nav-group>
