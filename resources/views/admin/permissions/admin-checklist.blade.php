@if($logged_in_user->hasAllAccess())
    <x-checklist-index
        formIndex="permissions"
        label="description"
        childrenLabel="description"
        relation="children"
        :form="$state ?? []"
        formElement="state.permissions"
        :categories="$adminPermissionCategories"
        :general="$generalAdminPermissions"
        header="Permissions"
    />
@endif
