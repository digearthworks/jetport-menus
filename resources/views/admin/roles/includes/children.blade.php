<li class="ml-4 list-none">
    @foreach($children as $permissionChild)
    <ul>

        <label class="flex items-center">
            @if( in_array((string) $permission->id, $updateRoleForm['permissions']))
                <svg class="w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>  <span class="ml-1 text-sm text-gray-600">{{ $permissionChild->description ?? $permissionChild->name }}</span>
            @else
                <x-jet-checkbox wire:model="updateRoleForm.permissions" :value="$permissionChild->id" />
                <span class="ml-1 text-sm text-gray-600">{{ $permissionChild->description ?? $permissionChild->name }}</span>
            @endif
        </label>

            @if($permissionChild->children->count())
                @include('admin.roles.includes.children', ['children' => $permission->children])
            @endif
    </ul>
    @endforeach
</li>
