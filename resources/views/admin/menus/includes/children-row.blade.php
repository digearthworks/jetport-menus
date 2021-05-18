    <x-livewire-tables::tw.table.cell class="border-l-4 border-blue-500">
        @if($row->parent()->exists())
            {{ $row->parent->group }}.{{ $row->group }}
        @else
            {{ $row->group }}
        @endif
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell class="border-l-8 border-transparent">
        {{ $row->name }}
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell class="border-l-8 border-transparent">
        <div class="flex items-center">{!! $row->link_with_art !!}</div>
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell class="border-l-8 border-transparent">
        {{ $parent->roles_count }}
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell class="border-l-8 border-transparent">
        {{ $parent->all_users_count }}
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell class="border-l-8 border-transparent">
        @include('admin.menus.includes.actions', ['model' => $row])
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell class="border-l-8 border-transparent" wire:key="table-row-{{ $child->uuid }}-column-6">
        @include('admin.menus.includes.has-children', ['menu' => $row])
    </x-livewire-tables::tw.table.cell>
@if($row->has('children'))
    @foreach($row->children as $child)
        <x-livewire-tables::tw.table.row
            class="text-gray-700 bg-gray-100 border-l-8 border-transparent hover:bg-white"
            x-show="open"
            wire:loading.class.delay="opacity-50"
            wire:key="table-row-{{ $child->uuid }}"
        >
            @include('admin.menus.includes.children-row', [ 'row' => $child ])

        </x-livewire-tables::tw.table.row>
    @endforeach
@endif
