<?php
namespace App\Http\Livewire;

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
