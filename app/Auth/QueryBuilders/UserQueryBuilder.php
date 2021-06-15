<?php

namespace App\Auth\QueryBuilders;

use App\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;

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
            $query->where('name', config('template.auth.access.role.admin'));
        });
    }

    public function admins() :self
    {
        return $this->where('type', User::TYPE_ADMIN);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function users() :self
    {
        return $this->where('type', User::TYPE_USER);
    }
}