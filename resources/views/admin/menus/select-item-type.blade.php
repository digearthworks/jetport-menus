<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="type" value="{{ __('Type') }}" />
    <select
    wire:model="state.type"
    wire:change="setUpSelects"
    id="type"
    class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @foreach(\App\Turbine\Menus\Enums\MenuItemTypeEnum::toArray() as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    <x-jet-input-error for="type" class="mt-2" />
</div>
