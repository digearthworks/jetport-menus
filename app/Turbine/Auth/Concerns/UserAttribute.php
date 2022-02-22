<?php

namespace App\Turbine\Auth\Concerns;

use Illuminate\Support\Facades\Hash;

/**
 * Trait UserAttribute.
 */
trait UserAttribute
{
    /**
     * -------------MUTATORS------------------
     *
     * @param $sort
     *
     * @return void
     */
    public function setSortAttribute($sort): void
    {
        $this->attributes['sort'] = $this->menu_id.str_replace($this->menu_id, '', $sort);
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password): void
    {
        // If password was accidentally passed in already hashed, try not to double hash it
        $this->attributes['password'] =
            (strlen($password) === 60 && preg_match('/^\$2y\$/', $password)) ||
            (strlen($password) === 95 && preg_match('/^\$argon2i\$/', $password)) ?
            $password :
            Hash::make($password);
    }
}
