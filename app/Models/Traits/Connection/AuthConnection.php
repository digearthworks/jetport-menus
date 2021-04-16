<?php

namespace App\Models\Traits\Connection;

trait AuthConnection
{
    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName(): string
    {
        return config('jetport.auth.database_connection');
    }
}
