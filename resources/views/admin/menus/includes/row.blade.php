<x-livewire-tables::tw.table.cell>
    {{ $model->parent->label??'Main' }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->group }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->name }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    <div class="flex items-center">{!! $row->link_with_art !!}</div>
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->roles_count }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    {{ $row->all_users_count }}
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    @include('admin.menus.includes.actions', ['model' => $row])
</x-livewire-tables::tw.table.cell>

<x-livewire-tables::tw.table.cell>
    @include('admin.menus.includes.has-children', ['menu' => $row])
</x-livewire-tables::tw.table.cell>
