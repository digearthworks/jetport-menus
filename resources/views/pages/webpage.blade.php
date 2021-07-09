<div class="pt-12 bg-gray-100 bg-opacity-40">
    <div class="flex flex-col items-center min-h-screen pt-6 sm:pt-0">
        <div>
            <h1 class="text-5xl">{{ $page->title }}</h1>
        </div>

        <div class="w-full p-6 mt-6 overflow-hidden prose bg-white shadow-md sm:max-w-2xl sm:rounded-lg">
            {!! $page->content !!}
        </div>
    </div>
</div>
