<?php

namespace Turbine\Auth\Models;

use Turbine\Concerns\CachesQueries;
use Turbine\Concerns\HasParent;

class Admin extends User
{
    use CachesQueries;
    use HasParent;

    public function guardName()
    {
        return parent::guardName();
    }
}
