<tbody x-data="{ open : false }">
  <x-livewire-tables::tw.table.cell>
        {{ isset($row->menu->type) ? $row->menu->type : $row->parentItem->menu->type }}
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell>
        {{ $row->handle }}
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell>
        <div class="flex items-center w-40 overflow-y-auto">{!! $row->uri_with_art !!}</div>
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell>
        {{ $row->roles_count }}
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell>
        {{ $row->all_users_count }}
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell>
        @include('admin.menus.actions', ['model' => $row])
    </x-livewire-tables::tw.table.cell>

    <x-livewire-tables::tw.table.cell>
        @include('admin.menus.has-children', ['menu' => $row])
    </x-livewire-tables::tw.table.cell>
@if($row->children()->exists())

    @foreach($row->children as $child)
        <x-livewire-tables::tw.table.row
            class="text-gray-700 bg-gray-100 border-l-4 border-indigo-400"
            x-cloak x-show="open"
            wire:loading.class.delay="opacity-50"
            wire:key="table-row-{{ $child->uuid }}"
        >
            @include('admin.menus.children-row', [ 'row' => $child, 'parentItem' => $row ])

        </x-livewire-tables::tw.table.row>
    @endforeach

@endif
</tbody>
