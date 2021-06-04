<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="handle" value="{{ __('Handle') }}" />
    <x-jet-input type="text" name="handle" class="block w-full mb-1" placeholder="{{ __('Name') }}"
        maxlength="100"
        wire:model="state.handle" required />
        <x-form-help-text value="The name of the menu, not to be displayed but for administrative purposes. i.e John Doe's Dashboard" />
    <x-input-error for="handle" class="mt-2" />
</div>
