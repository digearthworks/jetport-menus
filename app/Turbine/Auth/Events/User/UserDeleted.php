<?php

namespace App\Turbine\Auth\Events\User;

use Illuminate\Queue\SerializesModels;
use App\Turbine\Auth\Models\User;

/**
 * Class UserDeleted.
 */
class UserDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $user;

    /**
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
