<?php

namespace App\Models;

use App\Turbine\Concerns\CachesQueries;
use App\Turbine\Concerns\HasParent;

class Admin extends User
{
    use CachesQueries;
    use HasParent;

    public function guardName()
    {
        return parent::guardName();
    }
}
