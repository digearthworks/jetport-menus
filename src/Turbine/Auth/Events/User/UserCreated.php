<?php

namespace Turbine\Auth\Events\User;

use Illuminate\Queue\SerializesModels;
use Turbine\Auth\Models\User;

/**
 * Class UserCreated.
 */
class UserCreated
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
