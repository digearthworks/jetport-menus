<div x-data="{ expand : '' }">
    @isset($status)
        <livewire:admin.pages.livewire-datatable.datatable :status="$status" />
    @else
        <livewire:admin.pages.livewire-datatable.datatable />
    @endisset
</div>
