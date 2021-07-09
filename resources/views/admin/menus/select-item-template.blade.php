<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="group" value="{{ __('Template') }}" />
    <select
        wire:model="state.template"
        id="template"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @foreach(\Turbine\Menus\Enums\MenuItemTemplateEnum::toArray() as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    <x-jet-input-error for="template" class="mt-2" />
</div>
