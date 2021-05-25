<x-livewire-tables::tw.table.cell
    class="hover:bg-indigo-100 hover:ring-indigo-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    wire:click="$emit('selectIcon', '{{ $row->input }}')"
    x-on:click="open = false"
>
        {!! $row->art !!}
</x-livewire-tables::tw.table.cell>
