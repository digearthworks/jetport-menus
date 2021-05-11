<x-admin.users.livewire-tables.bs4.table>
    <x-slot name="head">
        @if (count($bulkActions))
            <x-admin.users.livewire-tables.bs4.table.heading>
                <input
                    wire:model="selectPage"
                    type="checkbox"
                />
            </x-admin.users.livewire-tables.bs4.table.heading>
        @endif

        @foreach($columns as $column)
            @if ($column->isVisible())
                @if ($column->isBlank())
                    <x-admin.users.livewire-tables.bs4.table.heading />
                @else
                    <x-admin.users.livewire-tables.bs4.table.heading
                        :sortable="$column->isSortable()"
                        :column="$column->column()"
                        :direction="$column->column() ? $sorts[$column->column()] ?? null : null"
                        :text="$column->text() ?? ''"
                        :class="$column->class() ?? ''"
                    />
                @endif
            @endif
        @endforeach
    </x-slot>

    <x-slot name="body">
        @include('admin.users.livewire-tables.bootstrap-4.includes.bulk-select-row')

        @forelse ($rows as $index => $row)
            <x-admin.users.livewire-tables.bs4.table.row
                wire:loading.class.delay="text-muted"
                wire:key="table-row-{{ $row->getKey() }}"
                :url="method_exists($this, 'getTableRowUrl') ? $this->getTableRowUrl($row) : null"
            >
                @if (count($bulkActions))
                    <x-admin.users.livewire-tables.bs4.table.cell>
                        <input
                            wire:model="selected"
                            wire:loading.attr.delay="disabled"
                            value="{{ $row->{$primaryKey} }}"
                            onclick="event.stopPropagation();return true;"
                            type="checkbox"
                        />
                    </x-admin.users.livewire-tables.bs4.table.cell>
                @endif

                @include($rowView, ['row' => $row])
            </x-admin.users.livewire-tables.bs4.table.row>
        @empty
            <x-admin.users.livewire-tables.bs4.table.row>
                <x-admin.users.livewire-tables.bs4.table.cell colspan="{{ count($bulkActions) ? count($columns) + 1 : count($columns) }}">
                    @lang($emptyMessage)
                </x-admin.users.livewire-tables.bs4.table.cell>
            </x-admin.users.livewire-tables.bs4.table.row>
        @endforelse
    </x-slot>
</x-admin.users.livewire-tables.bs4.table>
