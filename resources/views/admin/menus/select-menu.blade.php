<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="type" value="{{ __('Menu') }}" />
    <select
        id="parent_id"
        name="parent_id"
        wire:model="state.parent_id"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @foreach(\App\Turbine\Menus\Models\MenuItem::whereDoesntHave('page')->get() as $menuItem)
            <option value="{{$menuItem->id}}">{{ $menuItem->name }}</option>
        @endforeach
    </select>
    <x-jet-input-error for="parent_id" class="mt-2" />
</div>
