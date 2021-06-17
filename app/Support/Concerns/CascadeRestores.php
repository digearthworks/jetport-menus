<?php

namespace App\Support\Concerns;

trait CascadeRestores
{
    public function restore()
    {
        parent::restore();

        foreach ($this->cascadeRestores as $relationship) {
            $this->cascadeRestore($relationship);
        }
    }

    protected function cascadeRestore($relationship): void
    {
        foreach ($this->{$relationship}()->withTrashed()->get() as $model) {
            $model->pivot ? $model->pivot->restore() : $model->restore();
        }
    }
}
