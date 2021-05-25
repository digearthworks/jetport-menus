<div x-data="{ open: false}" class="relative w-32" x-on:mouseleave="open = false" >
    <a {{ $attributes->merge(['class' => 'p-0']) }}>

        <div :class="{'border-indigo-400': open, 'border-transparant': ! open}" class="absolute inset-0 transform -skew-y-6 border-4 shadow-lg bg-indigo-50 hover:border-gray-500 bg-gradient-to-r from-cyan-400 to-light-blue-500 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div x-on:mouseenter="open = true" class="relative w-32 h-32 px-2 py-10 overflow-hidden text-gray-500 shadow-lg cursor-pointer hover:text-gray-900 bg-gray-50 hover:bg-white focus:bg-white sm:rounded-3xl sm:p-16">
            <div class="absolute justify-center w-24 h-24 bottom-8 left-4 picture-box">
                {{ $slot ?? '' }}
            </div>
            <div class="absolute h-8 bottom-2 left-4">
                <p class="inline-block overflow-hidden leading-none tracking-tighter align-bottom">
                    {{ $caption ?? '' }}
                </p>
            </div>
        </div>
    </a>
</div>

<style>
    .picture-box > svg, .picture-box > img, .picture-box > i {
        height: 100% !important;
        width: 100% !important;
        font-size: 70px !important;
     }
     .picture-box > i {
         padding-top: 15px;
         padding-left: 10px;
     }
</style>


