<?php

namespace App\Events\User;

use App\Auth\Models\User;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserDestroyed.
 */
class UserDestroyed
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
