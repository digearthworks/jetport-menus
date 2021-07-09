<div class="px-2">
    <x-jet-label for="name" value="{{ __('Name') }}" />
    <x-jet-input wire:model="state.name"
        type="text" name="name" class="block w-full mb-1" placeholder="{{ __('Name') }}"
        maxlength="100"
    />
    <x-jet-input-error for="name" class="mt-2" />
</div>





