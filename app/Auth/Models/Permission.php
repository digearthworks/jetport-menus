<?php

namespace App\Auth\Models;

use App\Auth\Concerns\GetsAuthConnection;
use App\Auth\Concerns\PermissionRelationship;
use App\Auth\QueryBuilders\PermissionQueryBuilder;
use App\Support\Concerns\HasUuid;
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
