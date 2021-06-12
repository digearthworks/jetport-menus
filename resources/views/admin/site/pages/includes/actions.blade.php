<div class="flex items-center">

    @if ($page->trashed() && $logged_in_user->hasAllAccess())
        <x-button wire:click="confirm('restore', {{ $page->id }})">
            {{ __('Restore') }}
        </x-button>
    @elseif (! $page->isActive())
        <x-refresh-button wire:click="confirm('reactivate', {{ $page->id }})"/>
    @else
        <a href="/iframes/pages/{{ $page->slug }}">
            <x-show-button />
        </a>

        <x-edit-button wire:click="dialog('edit', {{ $page->id }})" id="editPageButton_{{ $page->id }}" />

        <x-delete-button wire:click="confirm('delete', {{ $page->id }})" />

        <x-ban-button title="Deactivate" wire:click="confirm('deactivate', {{ $page->id }})" />
    @endif
</div>
