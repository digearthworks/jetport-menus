<?php

namespace App\Auth\Models;

use App\Auth\Concerns\GetsAuthConnection;
use App\Auth\Concerns\PermissionRelationship;
use App\Auth\Concerns\PermissionScope;
use App\Support\Concerns\HasUuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Wildside\Userstamps\Userstamps;

class Permission extends SpatiePermission
{
    use GetsAuthConnection,
        HasUuid,
        PermissionRelationship,
        PermissionScope,
        SoftDeletes,
        Userstamps;
}
