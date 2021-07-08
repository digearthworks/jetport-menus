<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="type" value="{{ __('Link Target') }}" />
    <select
    wire:model="state.target"
    id="target"
    class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @foreach(\Turbine\Menus\Enums\MenuItemTargetEnum::toArray() as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    <x-jet-input-error for="target" class="mt-2" />
</div>
