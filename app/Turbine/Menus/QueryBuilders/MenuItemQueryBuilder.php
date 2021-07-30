<?php

namespace App\Turbine\Menus\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use App\Turbine\Menus\Models\Menu;

class MenuItemQueryBuilder extends Builder
{
    public function search($search): self
    {
        $search = is_array($search) ? $search : [$search];

        $fields = ['children' => ['name', 'uri', 'handle' , 'type'], 'name', 'uri', 'handle', 'type'];

        // orWhereHas will use joins, so we'll start with fields foreach
        foreach ($fields as $relation => $field) {
            if (is_array($field)) {
                // here we join table for each relation
                $this->orWhereHas($relation, function ($q) use ($field, $search) {

                    // here we need to use nested where like: ... WHERE key = fk AND (x LIKE y OR z LIKE y)
                    $q->where(function ($q) use ($field, $search) {
                        foreach ($field as $relatedField) {
                            foreach ($search as $term) {
                                $q->orWhere($relatedField, 'like', "%{$term}%");
                            }
                        }
                    });
                });
                $this->with($relation, function ($q) use ($field, $search) {

                    // here we need to use nested where like: ... WHERE key = fk AND (x LIKE y OR z LIKE y)
                    $q->where(function ($q) use ($field, $search) {
                        foreach ($field as $relatedField) {
                            foreach ($search as $term) {
                                $q->orWhere($relatedField, 'like', "%{$term}%");
                            }
                        }
                    });
                });
            } else {
                foreach ($search as $term) {
                    $this->orWhere($field, 'like', "%{$term}%");
                }
            }
        }
        $this->with('icon', 'children', 'parentItem', 'page');

        return $this;
    }

    public function onlyDeactivated() : self
    {
        return $this->whereActive(false);
    }

    public function onlyActive() : self
    {
        return $this->whereActive(true);
    }

    public function byType($type) : self
    {
        return $this->where('type', $type);
    }

    public function forUsers() : self
    {
        return $this->whereIn('menu_id', Menu::forUsers()->pluck('id')->toArray());
    }

    public function forGuests() : self
    {
        return $this->whereIn('menu_id', Menu::forGuests()->pluck('id')->toArray());
    }

    public function forAdmins() : self
    {
        return $this->whereIn('menu_id', Menu::forAdmins()->pluck('id')->toArray());
    }
}
