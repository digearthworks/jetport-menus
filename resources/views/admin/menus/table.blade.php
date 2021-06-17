<div x-data="{ expand : '' }">
    @isset($status)
        <livewire:admin.menus.livewire-datatable.datatable :status="$status" />
    @else
        <livewire:admin.menus.livewire-datatable.datatable />
    @endisset
</div>
