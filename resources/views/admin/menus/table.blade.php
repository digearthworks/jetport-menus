<div x-data="{ expand : '' }">

    @isset($status)
        <livewire:turbine.menus.admin.menu-items-table :status="$status" />
    @else
        <livewire:turbine.menus.admin.menu-items-table />
    @endisset

</div>
