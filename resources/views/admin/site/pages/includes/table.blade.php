<div x-data="{ expand : '' }">
    @isset($status)
        <livewire:admin.site.pages.livewire-datatable.datatable :status="$status" />
    @else
        <livewire:admin.site.pages.livewire-datatable.datatable />
    @endisset
</div>
