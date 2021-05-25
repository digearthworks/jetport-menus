<div x-data="{ expand : '' }">
    @isset($status)
        <livewire:admin.menu.menus-table :status="$status" />
    @else
        <livewire:admin.menu.menus-table />
    @endisset
</div>
