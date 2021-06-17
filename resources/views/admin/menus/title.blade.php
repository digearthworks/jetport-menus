<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="sort" value="{{ __('Description') }}" />
    <x-jet-input type="text" name="title" class="block w-full mb-1" placeholder="{{ __('Description') }}"
        maxlength="100"
        wire:model.defer="state.title" required />
    <x-input-error for="title" class="mt-2" />
</div>
