<?php

namespace App\Turbine\Concerns;

trait FiltersData
{
    protected function filterData(array $data): array
    {
        return array_filter($data, fn ($value) => $value !== '');
    }
}
