<?php

namespace Turbine\Query;

use Cache;
use Illuminate\Database\Query\Builder as QueryBuilder;

class CachingBuilder extends QueryBuilder
{
    /**
     * Run the query as a "select" statement against the connection.
     *
     * @return array
     */
    protected function runSelect()
    {
        if (config('turbine.database.cache_queries')) {
            return Cache::store('request')->remember($this->getCacheKey(), 1, function () {
                return parent::runSelect();
            });
        }

        return parent::runSelect();
    }

    /**
     * Returns a Unique String that can identify this Query.
     *
     * @return string
     */
    protected function getCacheKey()
    {
        return json_encode([
            $this->toSql() => $this->getBindings(),
        ]);
    }
}
