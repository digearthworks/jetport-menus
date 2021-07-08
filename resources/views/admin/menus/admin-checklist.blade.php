<x-checklist-index
    formIndex="menuItems"
    label="name_with_art"
    childrenLabel="uri_with_art"
    relation="children"
    :form="$state ?? []"
    formElement="state.menuItems"
    :categories="$adminMenuCategories"
    header="Menu Items"
/>
