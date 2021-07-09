<x-checklist-index
    formIndex="menuItems"
    label="handle_with_art"
    childrenLabel="uri_with_art"
    relation="children"
    :form="$state ?? []"
    formElement="state.menuItems"
    :categories="$userMenuCategories"
    header="Menu Items"
/>
