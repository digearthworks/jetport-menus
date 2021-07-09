<div x-on:click="(designerView === 'true') ? window.location = window.location.href.split('?')[0] : window.insertParam('designerView', true);" class="fixed bottom-0 right-0 w-16 h-16 mb-1 cursor-pointer">
    <button class="inline-flex items-center p-1 text-xs tracking-widest text-gray-400 uppercase transition duration-150 ease-in-out border-2 hover:text-gray-500 focus:outline-none active:text-gray-800 active:bg-gray-50 disabled:opacity-25">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
    </button>
</div>
