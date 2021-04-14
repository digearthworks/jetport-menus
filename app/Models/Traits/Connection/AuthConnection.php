<?php

namespace App\Models\Traits\Connection;

trait AuthConnection
{
    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return config('domains.auth.database_connection');
    }
}
