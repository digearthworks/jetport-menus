<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="iframe" value="{{ __('Iframe') }}" />
    <select
        id="iframe"
        name="iframe"
        wire:model="state.iframe"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        >
            @isset($model->iframe)
                <option value="{{$model->iframe}}">{{$model->iframe === 1 ? 'Yes' : 'No'}}</option>
            @endisset
        <option value="0">No</option>
        <option value="1">Yes</option>
    </select>
    <x-input-error for="iframe" class="mt-2" />
    <x-form-help-text class="mt-2" value="{{ __('Whether or not the link should open in an iframe') }}" />
    <x-jet-label for="name" value="{{ __('Link') }}" />

    <x-jet-input type="text" name="link" class="block w-full mb-1" placeholder="{{ __('Link') }}"
        maxlength="100"
        wire:model.defer="state.link" required />
    <x-input-error for="link" class="mt-2" />
</div>
