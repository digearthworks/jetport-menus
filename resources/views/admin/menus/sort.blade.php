@if(config('menus.allow_manual_sort'))
    <div class="col-span-6 sm:col-span-4">
        <x-jet-label for="sort" value="{{ __('Sort') }}" />
        <x-jet-input type="number" name="sort" class="block w-full mb-1" placeholder="{{ __('Sort') }}"
            maxlength="100"
            wire:model.defer="state.sort" required />
        <x-jet-input-error for="sort" class="mt-2" />
    </div>
@endif
