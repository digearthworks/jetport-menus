<div class="px-2">
    <x-jet-label for="slug" value="{{ __('Slug') }}" />
    <x-jet-input wire:model="state.slug" wire:change="sluggify"
        type="text" name="slug" class="block w-full mb-1" placeholder="{{ __('Slug') }}"
        maxlength="100"
    />
    <x-jet-input-error for="slug" class="mt-2" />
</div>

<div class="px-2">
    <x-jet-label for="layout" value="{{ __('Layout') }}" />
    <select
        id="layout"
        name="layout"
        wire:model="state.layout"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        <option value="layouts.welcome">Welcome</option>
        <option value="layouts.guest">Guest</option>
        <option value="layouts.blank">Blank</option>
    </select>
    <x-jet-input-error for="layout" class="mt-2" />
</div>

<div class="px-2">
    <x-jet-label for="template" value="{{ __('Template') }}" />
    <select
        onchange="if(confirm('Are you sure you want to clean the canvas?')){
            @this.swapTemplate(this.value);
        }"
        wire:model="state.template_id"
        id="template_id"
        name="template_id"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        <option></option>
        @foreach($templates as $template)
            <option value="{{ $template->id }}">{{ $template->name }}</option>
        @endforeach

    </select>
    <x-jet-input-error for="template" class="mt-2" />
</div>

<div class="px-2">
    <x-jet-label for="title" value="{{ __('Title') }}" />
    <x-jet-input type="text" name="title" class="block w-full mb-1" placeholder="{{ __('Title') }}"
        maxlength="100"
        wire:model="state.title" />
    <x-jet-input-error for="title" class="mt-2" />
    <x-form-help-text value="" />
</div>

<div class="px-2">
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
    <x-jet-input-error for="active" class="mt-2" />
</div>

<div class="px-2">
    <x-jet-label for="sort" value="{{ __('Sort') }}" />
    <x-jet-input type="number" name="sort" class="block w-full mb-1" placeholder="{{ __('Sort') }}"
        maxlength="100"
        wire:model.defer="state.sort" required />
    <x-jet-input-error for="sort" class="mt-2" />
</div>



