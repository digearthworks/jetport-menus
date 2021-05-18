<div x-data="{ expand : '' }">
    @isset($status)
        <livewire:menus-table :status="$status" />
    @else
        <livewire:menus-table />
    @endisset
</div>
