<x-navbar-nav-group :active="$active ?? false">
    <div class="flex flex-col p-0">
        <div class="flex flex-row items-center justify-around">
            {{ $header }}
        </div>
        <div class="flex flex-row items-center justify-around">
            {{ $slot }}
        </div>
    </div>
</x-navbar-nav-group>
