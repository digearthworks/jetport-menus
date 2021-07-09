<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="Uri" value="{{ __('Link') }}" />

    <x-jet-input type="text" name="uri" class="block w-full mb-1" placeholder="{{ __('Link') }}"
        maxlength="100"
        wire:model.defer="state.uri"/>
    <x-jet-input-error for="link" class="mt-2" />
</div>
