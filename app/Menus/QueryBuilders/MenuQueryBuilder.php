<?php

namespace App\Menus\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class MenuQueryBuilder extends Builder
{
    public function search($search): self
    {
        $search = is_array($search) ? $search : [$search];

        $fields = ['children' => ['name', 'link', 'group'], 'name', 'link', 'group'];

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

    public function sortGroup() : self
    {
        return $this->where('menu_id', $this->menu_id)->where('group', $this->group);
    }

    public function app() : self
    {
        return $this->where('group', 'app');
    }

    public function admin() : self
    {
        return $this->where('group', 'admin');
    }
}
