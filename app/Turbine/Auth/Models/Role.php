<?php

namespace App\Turbine\Auth\Models;

use App\Turbine\Auth\Concerns\GetsAuthConnection;
use App\Turbine\Auth\Concerns\HasPermissionsLabel;
use App\Turbine\Auth\Enums\UserTypeEnum;
use App\Turbine\Concerns\CachesQueries;
use App\Turbine\Concerns\HasUuid;
use App\Turbine\Menus\Concerns\HasMenuItems;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Wildside\Userstamps\Userstamps;

/**
 * Class Role.
 */
class Role extends SpatieRole
{
    use HasFactory;
    use HasMenuItems;
    use HasUuid;
    use GetsAuthConnection;
    use HasPermissionsLabel;
    use CachesQueries;
    use Userstamps;

    /**
     * @var string[]
     */
    protected $with = [
        'permissions',
        'users',
    ];

    protected $casts = [
        'type' => UserTypeEnum::class,
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
        return $this->name === config('turbine.admin.role');
    }
}
