<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="active" value="{{ __('Active') }}" />
    <select
    id="active"
    name="active"
    wire:model="form.active"
    class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @isset($model->active)
            <option value="{{$model->active}}">{{$model->active === 1 ? 'Yes' : 'No'}}</option>
        @endisset
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    <x-input-error for="active" class="mt-2" />
</div>
