<?php

namespace App\Models;

use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Relationship\PermissionRelationship;
use App\Models\Concerns\Scope\PermissionScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Wildside\Userstamps\Userstamps;

class Permission extends SpatiePermission
{
    use AuthConnection,
        HasUuid,
        PermissionRelationship,
        PermissionScope,
        SoftDeletes,
        Userstamps;
}
