<x-checklist-index
    formIndex="roles"
    label="name"
    :childrenLabels="['permissions' => 'description', 'menuItems' => 'name']"
    :relations="['permissions', 'menuItems']"
    :form="$state ?? []"
    formElement="state.roles"
    :categories="$userRoles"
    header="Roles"
    disableChildren="true"
/>
