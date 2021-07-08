@if($logged_in_user->hasAllAccess())
    <x-checklist-index
        formIndex="roles"
        label="name"
        :childrenLabels="['permissions' => 'description', 'menuItems' => 'name']"
        :relations="['permissions', 'menuItems']"
        :form="$state ?? []"
        formElement="state.roles"
        :categories="$adminRoles"
        header="Roles"
        disableChildren="true"
    />
@endif
