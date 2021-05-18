<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="type" value="{{ __('Menu') }}" />
    <select
        id="menu_id"
        name="menu_id"
        wire:model="form.menu_id"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        <option></option>
        @foreach(\App\Models\Menu::whereDoesntHave('parent')->get() as $menu)
            <option value="{{$menu->id}}">{{ $menu->name }}</option>
        @endforeach
    </select>
    <x-input-error for="menu_id" class="mt-2" />
</div>
