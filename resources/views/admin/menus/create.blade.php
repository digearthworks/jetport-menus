@inject('model', '\App\Models\User')
<x-dialog-modal maxWidth="2xl" wire:model="creating">

    <x-slot name="title">

    </x-slot>

    <x-slot name="content">

        <div x-data="{ menuType: '{{isset($form['type']) ? $form['type'] : 'main_menu'}}' }">

            @if(isset($item) && $item)
                @include('admin.menus.includes.form.select-menu')
            @endif

            @include('admin.menus.includes.form.name')

            @include('admin.menus.includes.form.title')

            @include('admin.menus.includes.form.select-type')

            <!-- Only shows if type is admin -->
            <div x-show="menuType !='main_menu'">
                @include('admin.menus.includes.form.link')
            </div>

            @include('admin.menus.includes.form.select-active')

            @include('admin.menus.includes.form.sort')

            @if(isset($item) && $item)
                @include('admin.menus.includes.form.select-item-group')
            @else
                @include('admin.menus.includes.form.select-group')
            @endif

            <div x-data="{ menuGroup: '{{ isset($model->group) ? $model->group : 'app'}}' }">

            </div>

        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeCreateDialog" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-jet-secondary-button>

        <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>

</x-dialog-modal>
