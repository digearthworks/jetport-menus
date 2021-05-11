@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
            :class="{ 'border-green-400 bg-green-100 border-l-4 text-green-400': style == 'success', 'text-red-700 bg-red-300 border-l-4 border-red-700': style == 'danger' }"
            style="display: none;"
            x-show="show && message"
            x-init="
                document.addEventListener('banner-message', event => {
                    style = event.detail.style;
                    message = event.detail.message;
                    show = true;
                });
            ">
    <div class="px-3 py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between">
            <div class="flex items-center flex-1 w-0 min-w-0">
                <span class="flex p-2 rounded-lg" :class="{ 'bg-green-400': style == 'success', 'bg-red-600': style == 'danger' }">
                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>

                @isset($custom)
                    {{ $custom }}
                @else
                    <p :class="{ 'ml-3 font-medium text-sm text-green-400 truncate' : style == 'success', 'ml-3 font-medium text-sm text-red-700 truncate' : style == 'danger' }" x-text="message"></p>
                @endisset
            </div>

            <div class="flex-shrink-0 sm:ml-3">
                <button
                    type="button"
                    class="flex p-2 -mr-1 transition duration-150 ease-in-out rounded-md focus:outline-none sm:-mr-2"
                    :class="{ 'hover:bg-green-400 focus:bg-green-400': style == 'success', 'hover:bg-red-600 focus:bg-red-600': style == 'danger' }"
                    aria-label="Dismiss"
                    x-on:click="show = false">
                    <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
