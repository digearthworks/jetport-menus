<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="type" value="{{ __('Type') }}" />
    <select
    x-on:change="menuType = $event.target.value"
    id="type"
    wire:model="state.type"
    class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @foreach(\App\Core\Menus\Enums\MenuType::toArray() as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    <x-input-error for="type" class="mt-2" />
</div>
