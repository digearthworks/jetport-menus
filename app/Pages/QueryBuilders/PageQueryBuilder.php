<?php

namespace App\Pages\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class PageQueryBuilder extends Builder
{
    public function search($term): self
    {
        return $this->where(function ($query) use ($term) {
            $query->where('title', 'like', '%' . $term . '%')
                ->orWhere('slug', 'like', '%' . $term . '%');
        });
    }


    public function welcomePages() :self
    {
        return $this->where('title', 'like', 'Welcome%')->ordered();
    }

    public function onlyDeactivated() : self
    {
        return $this->whereActive(false);
    }

    public function onlyActive() : self
    {
        return $this->whereActive(true);
    }
}
