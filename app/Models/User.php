<?php

namespace App\Models;

use App\Turbine\Auth\Models\User as ModelsUser;
use App\Turbine\Concerns\HasChildren;

class User extends ModelsUser
{
    use HasChildren;

    protected $childTypes = [
        'admin' => Admin::class,
        'user' => self::class,
    ];
}
