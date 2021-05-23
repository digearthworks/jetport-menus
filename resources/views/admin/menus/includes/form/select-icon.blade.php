<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="active" value="{{ __('Icon') }}" />
    <textarea
    id="select-from-existing-icons"
    name="icon_id"
    rows="2"
    wire:model="state.icon_id"
    class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
    </textarea>
    <x-input-error for="icon_id" class="mt-2" />
</div>

