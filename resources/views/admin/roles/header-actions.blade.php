<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

    @if(! str_contains(url()->current(), 'deactivated') && ! str_contains(url()->current(), 'deleted'))
        <livewire:turbine.auth.create-role-button />
    @endif
</div>
