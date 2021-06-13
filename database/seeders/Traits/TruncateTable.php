<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Class TruncateTable.
 */
trait TruncateTable
{
    /**
     * @param $table
     *
     * @return bool|null
     */
    protected function truncate($table, $connection = null): ?bool
    {
        switch (DB::connection($connection)->getDriverName()) {
            case 'mysql':
                return DB::connection($connection)->table($table)->truncate();

            case 'pgsql':
                return  DB::connection($connection)->statement('TRUNCATE TABLE '.$table.' RESTART IDENTITY CASCADE');

            case 'sqlite': case 'sqlsrv':
            return DB::connection($connection)->statement('DELETE FROM '.$table);
        }

        return false;
    }

    /**
     * @param array $tables
     *
     * @return void
     */
    protected function truncateMultiple(array $tables, $connection = null): void
    {
        foreach ($tables as $table) {
            $this->truncate($table, $connection);
        }
    }
}
