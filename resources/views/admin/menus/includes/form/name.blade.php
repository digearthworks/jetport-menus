<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="name" value="{{ __('Name') }}" />
    <x-jet-input type="text" name="name" class="block w-full mb-1" placeholder="{{ __('Name') }}"
        maxlength="100"
        wire:model.defer="form.name" required />
    <x-input-error for="name" class="mt-2" />
</div>
