<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="name" value="{{ __('Meta Name') }}" />
    <x-jet-input type="text" name="name" class="block w-full mb-1" placeholder="{{ __('Meta Name') }}"
        maxlength="100"
        wire:model="state.name" required />
    <x-input-error for="name" class="mt-2" />
    <x-form-help-text value="Used when searching for icon" />
</div>
