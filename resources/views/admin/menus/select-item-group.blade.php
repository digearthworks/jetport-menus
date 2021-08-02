<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="group" value="{{ __('Group') }}" />
    <select
        wire:model="state.menu_id"
        x-on:change="menuGroup = $event.target.value"
        id="menu_id"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @foreach(\App\Turbine\Menus\Models\Menu::all() as $group)

            <option value="{{ (string) $group->id }}">{{ $group->name }}</option>
        @endforeach
    </select>
    <x-jet-input-error for="menu_id" class="mt-2" />
</div>
