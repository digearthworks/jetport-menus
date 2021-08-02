<?php

namespace App\Turbine\Auth\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class PermissionQueryBuilder extends Builder
{
    public function isMaster() : self
    {
        return $this->whereDoesntHave('parent')
            ->whereHas('children');
    }

    public function isParent() : self
    {
        return $this->whereHas('children');
    }

    public function isChild() : self
    {
        return $this->whereHas('parent');
    }

    public function singular() : self
    {
        return $this->whereNull('parent_id')
            ->whereDoesntHave('children');
    }
}
