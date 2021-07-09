<div class="flex items-center">

    <a href="{{ route('admin.pages.templates.edit', ['template' => $template]) }}">
        <x-edit-button id="editPageButton_{{ $template->id }}"/>
    </a>

    <x-delete-button wire:click="confirm('delete', {{ $template->id }})" />

</div>
