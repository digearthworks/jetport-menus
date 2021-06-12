<?php

namespace App\Models\Concerns;

use Spatie\EloquentSortable\SortableTrait;

trait HasIterativeQuickSort
{
    use SortableTrait;

    public function insertAtSortPosition(int $sort)
    {
        if ($this->sort === $sort) {
            return;
        }

        if (!$this->sortCollisions($this->id, $sort)->count()) {
            return $this->update([
                'sort' => $sort,
            ]);
        }

        return $this->shouldMoveOrderUp($sort) ?
            $this->moveOrderUpMany(($this->sort - $sort)) :
            $this->moveOrderDownMany(($sort - $this->sort));
    }

    public function shouldMoveOrderUp(int $sort) : bool
    {
        return $this->sort > $sort;
    }

    public function getSortDiff(int $sort) : int
    {
        return $this->shouldMoveOrderUp($sort) ? $this->sort - $sort : $sort - $this->sort;
    }

    public function scopeSortCollisions($query, $id, $sort)
    {
        return $query->where('sort', $sort)->where('id', '!=', $id);
    }

    public function moveOrderDownMany(int $count) : void
    {
        for ($i = 0; $i < $count; $i++) {
            $this->moveOrderDown();
        }
    }

    public function moveOrderUpMany(int $count) : void
    {
        for ($i = 0; $i < $count; $i++) {
            $this->moveOrderUp();
        }
    }
}
