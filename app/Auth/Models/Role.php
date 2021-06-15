<?php

namespace App\Auth\Models;

use App\Auth\Concerns\GetsAuthConnection;
use App\Auth\Concerns\HasPermissionsLabel;
use App\Menus\Concerns\HasMenus;
use App\Support\Concerns\HasUuid;
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
        GetsAuthConnection,
        HasPermissionsLabel,
        SoftDeletes,
        Userstamps;

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
        'users'
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

    public function isAdmin(): bool
    {
        return $this->name === config('template.auth.access.role.admin');
    }
}
