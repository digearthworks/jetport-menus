<?php

namespace App\Events\User;

use App\Models\User;
use Illuminate\Queue\SerializesModels;

/**
 * Class UserUpdated.
 */
class UserUpdated
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
