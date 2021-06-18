<?php

namespace App\Core\Auth\Models;

use App\Core\Auth\Concerns\GetsAuthConnection;
use App\Core\Auth\Concerns\PermissionRelationship;
use App\Core\Auth\QueryBuilders\PermissionQueryBuilder;
use App\Core\Support\Concerns\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Wildside\Userstamps\Userstamps;

class Permission extends SpatiePermission
{
    use GetsAuthConnection,
        HasUuid,
        PermissionRelationship,
        SoftDeletes,
        Userstamps;

    public function newEloquentBuilder($query): PermissionQueryBuilder
    {
        return new PermissionQueryBuilder($query);
    }
}
