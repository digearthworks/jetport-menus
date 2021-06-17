<?php

namespace App\Support\Concerns;

trait CascadeRestores
{
    protected function cascadeRestore($relationship): void
    {
        foreach ($this->{$relationship}()->withTrashed()->get() as $model) {
            $model->pivot ? $model->pivot->restore() : $model->restore();
        }
    }
}
