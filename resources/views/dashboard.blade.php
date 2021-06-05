<x-7xl>
    <x-slot name="header">
        <div class="inline-flex items-center">
            @if($logged_in_user->isAdmin())
                {{__('Welcome, Admin.')}}
            @else
                {{__('Welcome, :user!', ['user' => $logged_in_user->name])}}
            @endif
        </div>

    </x-slot>
        <livewire:includes.dashboard-grid />
</x-7xl>
@if($logged_in_user->isAdmin())
    <livewire:admin.menus.edit />
    <livewire:admin.menus.delete />
@endif

