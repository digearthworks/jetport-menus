<?php

namespace App\Models;

use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Relationship\PermissionRelationship;
use App\Models\Concerns\Scope\PermissionScope;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasUuid,
        PermissionRelationship,
        PermissionScope,
        AuthConnection;
}
