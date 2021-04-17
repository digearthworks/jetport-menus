@if (\App\Models\User::query()->where('id', $row->id)->first()->isVerified())
    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
        <div x-on:mouseenter.debounce.100="tooltip = true" x-on:mouseleave.debounce.200="tooltip = false" class="px-2 text-sm rounded-md bg-green-400 cursor-default text-white shadow">
            @lang('Yes')
        </div>
        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
          <div class="absolute top-0 z-10 w-32 p-2 -mt-1 text-sm leading-tight transform -translate-x-1/2 -translate-y-full bg-white border-t-4 border-gray-500 text-gray-700 rounded-lg shadow-lg">
            {{ now()->toDayDateTimeString($value) }}
          </div>
          <svg class="absolute z-10 ml-4 w-6 h-6 text-white transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
            <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
          </svg>
        </div>
    </div>
@else
    <x-danger-badge value="{{ __('No') }}" />
@endif
