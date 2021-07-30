<?php

namespace App\Turbine\Auth\Events\Role;

use Illuminate\Queue\SerializesModels;
use App\Turbine\Auth\Models\Role;

/**
 * Class RoleCreated.
 */
class RoleCreated
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
