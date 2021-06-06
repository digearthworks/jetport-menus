<x-welcome-layout>
    <div class="pt-12">
        <h1 class="text-7xl">{{ $welcomePage->title ?? appName() }}</h1>
    </div>

    <div class="prose">
        {!! $welcomePage->content ?? $welcome !!}
    </div>
</x-welcome-layout>
