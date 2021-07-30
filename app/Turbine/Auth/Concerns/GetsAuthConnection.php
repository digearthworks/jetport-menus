<?php

namespace App\Turbine\Auth\Concerns;

trait GetsAuthConnection
{
    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName(): string
    {
        return config('turbine.auth.connection');
    }

    public function getFullTableName()
    {
        return $this->getConnection()->getTablePrefix() . $this->getTable();
    }
}
