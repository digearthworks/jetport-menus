<?php

namespace App\Turbine\Auth\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use App\Turbine\Auth\Enums\UserTypeEnum;

class UserQueryBuilder extends Builder
{
    public function search($term) : self
    {
        return $this->where(function ($query) use ($term) {
            $query->where('name', 'like', '%'.$term.'%')
                ->orWhere('email', 'like', '%'.$term.'%');
        });
    }

    public function onlyDeactivated() : self
    {
        return $this->whereActive(false);
    }

    public function onlyActive()
    {
        return $this->whereActive(true);
    }

    public function byType($type) :self
    {
        return $this->where('type', $type);
    }

    public function allAccess() :self
    {
        return $this->whereHas('roles', function ($query) {
            $query->where('name', config('turbine.admin.role'));
        });
    }

    public function admins() :self
    {
        return $this->where('type', UserTypeEnum::admin());
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function users() :self
    {
        return $this->where('type', UserTypeEnum::user());
    }
}
