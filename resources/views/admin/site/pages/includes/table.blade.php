<div x-data="{ expand : '' }">
    @isset($status)
        <livewire:admin.site.site-pages-table :status="$status" />
    @else
        <livewire:admin.site.site-pages-table />
    @endisset
</div>
