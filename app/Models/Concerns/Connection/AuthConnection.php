<?php

namespace App\Models\Concerns\Connection;

trait AuthConnection
{
    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName(): string
    {
        return config('template.auth.database_connection');
    }
}
