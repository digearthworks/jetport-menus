<?php

namespace App\Models;

use App\Models\Concerns\Attribute\RoleAttribute;
use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasMenus;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Method\RoleMethod;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;
use Wildside\Userstamps\Userstamps;

/**
 * Class Role.
 */
class Role extends SpatieRole
{
    use HasFactory,
        HasMenus,
        HasUuid,
        AuthConnection,
        RoleAttribute,
        RoleMethod,
        SoftDeletes,
        Userstamps;

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
        'users'
    ];

    protected $appends = ['users_list'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return RoleFactory::new();
    }

    public function getUsersListAttribute()
    {
        return $this->users;
    }
}
