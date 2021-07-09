<div x-data="{ expand : '' }">
    @isset($status)
        <livewire:turbine.pages.pages-table :status="$status" />
    @else
        <livewire:turbine.pages.pages-table />
    @endisset
</div>
