<?php

namespace App\Core\Icons\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class IconQueryBuilder extends Builder
{
    public function search($term): self
    {
        return $this->where(function ($query) use ($term) {
            $query->where('html', 'like', '%' . $term . '%')
                ->orWhere('class', 'like', '%' . $term . '%')
                ->orWhere('meta', 'like', '%' . $term . '%');
        });
    }
}
