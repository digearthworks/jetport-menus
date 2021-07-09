<x-checklist-index
    formIndex="permissions"
    label="description"
    childrenLabel="description"
    relation="children"
    :form="$state ?? []"
    formElement="state.permissions"
    :categories="$userPermissionCategories"
    :general="$generalUserPermissions"
    header="Permissions"
/>
