<?php

namespace App\Core\Events\User;

use App\Core\Auth\Models\User;
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
