<div class="col-span-6 sm:col-span-4">
    <x-jet-label class="underline" for="updatingRoles" value="{{ __('Permission Categories') }}" />
</div>

@if ($permissions->where('type', $type)->whereNull('parent_id')->count())
    <div class="grid grid-cols-1 md:grid-cols-2">
        @foreach ($permissions->where('type', $type)->whereNull('parent_id') as $permission)
            <div
                class="border-gray-300 p-1 m-0.5 rounded-md border hover:border-blue-300 hover:shadow-outline-blue">
                <label class="flex items-center">
                    <x-jet-checkbox wire:model="updateRoleForm.permissions" :value="$permission->id" />
                    <span class="ml-1 text-sm text-gray-600">{{ $permission->description ?? $permission->name }}</span>
                </label>

                @if ($permission->children->count())
                    @include('admin.roles.includes.children', ['children' => $permission->children])
                @endif
            </div>
        @endforeach
    </div>
@endif
