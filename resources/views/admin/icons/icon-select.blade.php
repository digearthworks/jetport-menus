<div class="flex flex-col items-center">
    <div class="flex flex-col items-center w-full h-64">
        <div class="w-full px-4">
            <div class="relative flex flex-col items-center">
                <div class="w-full">
                    <div class="flex p-1 my-2 bg-white border border-gray-200 rounded">
                        <div class="flex flex-wrap flex-auto"></div>
                        <input x-on:focus="open = true" wire:model.debounce.50ms="query" placeholder="Search Icons" class="w-full p-1 px-2 text-gray-800 outline-none appearance-none">
                    </div>
                </div>

                <div x-show="open" class="absolute z-40 w-full overflow-x-hidden overflow-y-auto bg-white rounded shadow top-100 lef-0 max-h-select svelte-5uyqqj">
                    <div class="flex flex-col w-full">
                        <div class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100">
                         @forelse($icons as $icon)
                              <div wire:click="$emit('selectIcon', '{{ $icon['input'] }}')"
                                    x-on:click="open = false"
                                    class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent hover:bg-indigo-100 hover:ring-indigo-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                  <div class="flex flex-col items-center w-6">
                                      <div class="relative flex items-center justify-center w-4 h-4 m-1 mt-1 mr-2 rounded-full "> {!! $icon['art'] !!} </div>
                                  </div>
                                  <div class="flex items-center w-full">
                                      <div class="mx-2 -mt-1 ">
                                          <div class="w-full -mt-1 text-xs font-normal text-gray-500 normal-case truncate">{{ $icon['input']  }}</div>
                                      </div>
                                  </div>
                              </div>
                          @empty
                            <div class="flex items-center justify-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>

                                <span class="py-8 text-xl font-medium text-gray-400">No items found. Try narrowing your search.</span>
                            </div>
                          @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
