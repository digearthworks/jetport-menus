<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="group" value="{{ __('Group') }}" />
    <select
        x-on:change="menuGroup = $event.target.value"
        id="group"
        name="group"
        wire:model="state.group"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @if(isset($model->group))
            <option value="{{$model->group}}">
                @switch($model->group)
                    @case('hotlinks')
                        Navigation
                        @break
                    @case('main')
                        Menu Page
                    @break
                @endswitch
            </option>
        @endif
        <option value="main">Menu Page</option>
        <option value="hotlinks">Navigation</option>
    </select>
    <x-input-error for="group" class="mt-2" />
</div>
