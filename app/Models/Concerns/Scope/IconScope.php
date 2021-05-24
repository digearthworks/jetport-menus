<?php

namespace App\Models\Concerns\Scope;


trait IconScope
{
        /**
     * @param $query
     * @param $term
     *
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('html', 'like', '%'.$term.'%')
                ->orWhere('class', 'like', '%'.$term.'%');
        });
    }
}
