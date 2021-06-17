<x-livewire-tables::tw.table.cell class="w-16">
    <div class="flex items-center w-full h-16 justify-evenly">
        <span class="h-full picture-box">
            {!! $row->art !!}
        </span>
    </div>
</x-livewire-tables::tw.table.cell>
<x-livewire-tables::tw.table.cell class="w-36">
    <div x-data="{ tooltip: false }" class="w-full py-0 my-0">
        <div class="relative" x-cloak x-show="tooltip">
            <div class="absolute top-0 z-10 p-2 -mt-1 text-sm leading-tight text-gray-700 transform -translate-x-1/2 -translate-y-full bg-white border-t-4 border-gray-500 rounded-lg shadow-lg w-36">
              Copied to Clipboard!
            </div>
            <svg class="absolute z-10 w-6 h-6 ml-8 text-white transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
              <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
            </svg>
          </div>
        <x-textarea x-on:click="$clipboard('{{ trim($row->input) }}'); tooltip = true; setTimeout(() => tooltip = false, 1000)" readonly class="text-xs" cols="80" rows="4">
            {{ trim($row->input) }}
        </x-textarea>
    </div>
</x-livewire-tables::tw.table.cell>
<x-livewire-tables::tw.table.cell>
    <div class="w-24">
        {!! $row->meta_label !!}
    </div>
</x-livewire-tables::tw.table.cell>
<x-livewire-tables::tw.table.cell>
    <div class="w-24">
        {!! $row->menus_label !!}
    </div>
</x-livewire-tables::tw.table.cell>
<x-livewire-tables::tw.table.cell>
    <div class="flex items-center">
        @if($row->meta && $row->id)
            @if($row->id !== 1 && ! $row->menus()->exists())
                <x-delete-button wire:click="confirm('delete', {{ $row->id }})" />
            @endif
            <x-edit-button wire:click="dialog('edit', {{ $row->id }})" id="editIconButton_{{ $row->id }}" />
        @endif
    </div>
</x-livewire-tables::tw.table.cell>
