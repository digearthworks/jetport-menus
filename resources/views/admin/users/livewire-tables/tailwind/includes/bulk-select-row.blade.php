@if (isset($bulkActions) && count($bulkActions) && (($selectPage && $rows->total() > $rows->count()) || isset($selected) && count($selected)))
    <x-turbine-auth::livewire-tables.table.row wire:key="row-message" class="bg-indigo-50">
        <x-turbine-auth::livewire-tables.table.cell :colspan="(isset($bulkActions) && count($bulkActions)) ? count($columns) + 1 : count($columns)">
            @if (count($selected) && !$selectAll && !$selectPage)
                <div>
                    <span>
                        @lang('You have selected')
                        <strong>{{ count($selected) }}</strong>
                        @lang(':rows', ['rows' => count($selected) === 1 ? 'row' : 'rows']).
                    </span>

                    <button
                        wire:click="resetBulk"
                        wire:loading.attr="disabled"
                        type="button"
                        class="ml-1 text-sm font-medium leading-5 text-gray-700 text-blue-600 underline transition duration-150 ease-in-out focus:outline-none focus:text-gray-800 focus:underline"
                    >
                        @lang('Unselect All')
                    </button>
                </div>
            @elseif ($selectAll)
                <div>
                    <span>
                        @lang('You are currently selecting all')
                        <strong>{{ number_format($rows->total()) }}</strong>
                        @lang('rows').
                    </span>

                    <button
                        wire:click="resetBulk"
                        wire:loading.attr="disabled"
                        type="button"
                        class="ml-1 text-sm font-medium leading-5 text-gray-700 text-blue-600 underline transition duration-150 ease-in-out focus:outline-none focus:text-gray-800 focus:underline"
                    >
                        @lang('Unselect All')
                    </button>
                </div>
            @else
                @if ($rows->total() === count($selected))
                    <div>
                        <span>
                            @lang('You have selected')
                            <strong>{{ count($selected) }}</strong>
                            @lang(':rows', ['rows' => count($selected) === 1 ? 'row' : 'rows']).
                        </span>

                        <button
                            wire:click="resetBulk"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-sm font-medium leading-5 text-gray-700 text-blue-600 underline transition duration-150 ease-in-out focus:outline-none focus:text-gray-800 focus:underline"
                        >
                            @lang('Unselect All')
                        </button>
                    </div>
                @else
                    <div>
                        <span>
                            @lang('You have selected')
                            <strong>{{ $rows->count() }}</strong>
                            @lang('rows, do you want to select all')
                            <strong>{{ number_format($rows->total()) }}</strong>?
                        </span>

                        <button
                            wire:click="selectAll"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-sm font-medium leading-5 text-gray-700 text-blue-600 underline transition duration-150 ease-in-out focus:outline-none focus:text-gray-800 focus:underline"
                        >
                            @lang('Select All')
                        </button>

                        <button
                            wire:click="resetBulk"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-sm font-medium leading-5 text-gray-700 text-blue-600 underline transition duration-150 ease-in-out focus:outline-none focus:text-gray-800 focus:underline"
                        >
                            @lang('Unselect All')
                        </button>
                    </div>
                @endif
            @endif
        </x-turbine-auth::livewire-tables.table.cell>
    </x-turbine-auth::livewire-tables.table.row>
@endif
