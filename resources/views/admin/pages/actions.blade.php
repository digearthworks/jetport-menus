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
        <a href="{{ route('admin.pages.edit', ['page' => $page]) }}">
            <x-edit-button id="editPageButton_{{ $page->id }}"/>
        </a>

        <x-delete-button wire:click="confirm('delete', {{ $page->id }})" />

        <x-ban-button title="Deactivate" wire:click="confirm('deactivate', {{ $page->id }})" />
    @endif
</div>
