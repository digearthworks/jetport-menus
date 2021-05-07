<?php

namespace App\Models;

use App\Models\Traits\Attribute\RoleAttribute;
use App\Models\Traits\Connection\AuthConnection;
use App\Models\Traits\HasUuid;
use App\Models\Traits\Method\RoleMethod;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Wildside\Userstamps\Userstamps;

/**
 * Class Role.
 */
class Role extends SpatieRole
{
    use HasFactory,
        HasUuid,
        AuthConnection,
        RoleAttribute,
        RoleMethod,
        Userstamps;

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}
