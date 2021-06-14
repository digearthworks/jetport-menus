<?php

namespace App\Icons\Concerns;

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
            $query->where('html', 'like', '%' . $term . '%')
                ->orWhere('class', 'like', '%' . $term . '%')
                ->orWhere('meta', 'like', '%' . $term . '%');
        });
    }
}
