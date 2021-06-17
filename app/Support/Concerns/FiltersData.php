<?php

namespace App\Support\Concerns;

trait FiltersData
{
    protected function filterData(array $data): array
    {
        return array_filter($data, fn ($val) => $val !== "");
    }
}
