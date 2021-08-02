<?php
namespace App\Turbine\Livewire\Concerns;

/**
 * Requires Eloquent Repository (model) property
 * e.g. public $eloquentRepository = App\Turbine\Auth\Models\User::class
 */
trait HasModel
{
    public $modelId;

    public $withTrashed = false;

    public function getModelProperty()
    {
        $query = $this->eloquentRepository::query();
        if ($this->withTrashed) {
            $query->withTrashed();
        }

        return $query->find($this->modelId);
    }
}
