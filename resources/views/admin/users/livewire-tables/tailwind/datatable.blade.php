<div
    @if (is_numeric($refresh))
        wire:poll.{{ $refresh }}ms
    @elseif(is_string($refresh))
        @if ($refresh === '.keep-alive' || $refresh === 'keep-alive')
            wire:poll.keep-alive
        @elseif($refresh === '.visible' || $refresh === 'visible')
            wire:poll.visible
        @else
            wire:poll="{{ $refresh }}"
        @endif
    @endif
>
    @include('admin.users.livewire-tables.tailwind.includes.offline')

    <div>
        @include('admin.users.livewire-tables.tailwind.includes.sorting-pills')
        @include('admin.users.livewire-tables.tailwind.includes.filter-pills')

        <div class="p-6 md:flex md:justify-between md:p-0">
            <div class="w-full mb-4 space-y-4 md:mb-0 md:w-2/4 md:flex md:space-y-0 md:space-x-4">
                @include('admin.users.livewire-tables.tailwind.includes.search')
                @include('admin.users.livewire-tables.tailwind.includes.filters')
            </div>

            <div class="md:space-x-2 md:flex md:items-center">
                @include('admin.users.livewire-tables.tailwind.includes.bulk-actions')
                @include('admin.users.livewire-tables.tailwind.includes.per-page')
            </div>
        </div>

        @include('admin.users.livewire-tables.tailwind.includes.table')
        @include('admin.users.livewire-tables.tailwind.includes.pagination')
    </div>
</div>
