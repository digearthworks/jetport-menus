<?php

namespace App\Turbine\Auth\Events\Role;

use Illuminate\Queue\SerializesModels;
use App\Turbine\Auth\Models\Role;

/**
 * Class RoleDeleted.
 */
class RoleDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $role;

    /**
     * @param $role
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}
