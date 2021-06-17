<div class="col-span-6 sm:col-span-4">
    <x-jet-label for="type" value="{{ __('Page') }}" />
    <select
        wire:model="state.page_id"
        id="page_id"
        name="page_id"
        class="block w-full mb-2 border-gray-300 rounded-md shadow-sm form-select focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
    >
        @foreach(\App\Pages\Models\Page::query()->onlyActive()->get() as $page)
            <option value="{{ $page->id }}">{{ $page->slug }}</option>
        @endforeach
    </select>
    <x-input-error for="page_id" class="mt-2" />
</div>
