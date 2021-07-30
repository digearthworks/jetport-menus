<?php

namespace App\Turbine\Auth\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Turbine\Auth\Concerns\GetsAuthConnection;
use App\Turbine\Auth\Concerns\PermissionRelationship;
use App\Turbine\Auth\QueryBuilders\PermissionQueryBuilder;
use App\Turbine\Concerns\CachesQueries;
use App\Turbine\Concerns\HasUuid;
use Wildside\Userstamps\Userstamps;

class Permission extends SpatiePermission
{
    use GetsAuthConnection;
    use CachesQueries;
    use HasUuid;
    use PermissionRelationship;
    use Userstamps;

    public function newEloquentBuilder($query): PermissionQueryBuilder
    {
        return new PermissionQueryBuilder($query);
    }
}
