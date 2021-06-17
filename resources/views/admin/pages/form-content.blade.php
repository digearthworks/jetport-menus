<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="title" value="{{ __('Title') }}" />
    <x-jet-input type="text" name="title" class="block w-full mb-1" placeholder="{{ __('Title') }}"
        maxlength="100"
        wire:model="state.title" />
    <x-input-error for="title" class="mt-2" />
    <x-form-help-text value="" />
</div>

<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="slug" value="{{ __('Slug') }}" />
    <x-jet-input wire:model="state.slug" wire:change="sluggify"
        type="text" name="slug" class="block w-full mb-1" placeholder="{{ __('Slug') }}"
        maxlength="100"
    />
    <x-input-error for="slug" class="mt-2" />
</div>

<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="body" value="{{ __('Body') }}" />
    <x-textarea
        wire:model="state.body"
        id="page-body"
        name="body"
        rows="5"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    />
    <x-input-error for="body" class="mt-2" />
</div>

<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="layout" value="{{ __('Layout') }}" />
    <select
        id="layout"
        name="layout"
        wire:model="state.layout"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        <option value="layouts.welcome">Welcome</option>
        <option value="layouts.guest">Guest</option>
    </select>
    <x-input-error for="layout" class="mt-2" />
</div>

<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="active" value="{{ __('Active') }}" />
    <select
        id="active"
        name="active"
        wire:model="state.active"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    <x-input-error for="active" class="mt-2" />
</div>

<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="sort" value="{{ __('Sort') }}" />
    <x-jet-input type="number" name="sort" class="block w-full mb-1" placeholder="{{ __('Sort') }}"
        maxlength="100"
        wire:model.defer="state.sort" required />
    <x-input-error for="sort" class="mt-2" />
</div>
