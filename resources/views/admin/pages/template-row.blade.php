<x-livewire-tables::tw.table.cell>
    {{ $row->name }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->author->name ?? 'Unknown' }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->updated_at->format('m-d-Y H:i:s') }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->created_at->format('m-d-Y H:i:s') }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    @include('admin.pages.template-actions', ['template' => $row])
</x-livewire-tables::tw.table.cell>
