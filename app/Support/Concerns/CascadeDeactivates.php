<?php

namespace App\Support\Concerns;

trait CascadeDeactivates
{

    public function activate(): void
    {
        $this->update(['active' => 1]);

        foreach ($this->cascadeReactivates as $relationship) {
            $this->cascadeReactivate($relationship);
        }
    }

    public function deactivate(): void
    {
        $this->update(['active' => 0]);

        foreach ($this->cascadeDeactivates as $relationship) {
            $this->cascadeDeactivate($relationship);
        }
    }

    /**
     * Cascade deactivate the given relationship on the given mode.
     *
     * @param string  $relationship
     *
     * @return void
     */
    protected function cascadeDeactivate($relationship): void
    {
        foreach ($this->{$relationship}()->get() as $model) {
            $model->pivot ? $model->pivot->deactivate() : $model->deactivate();
        }
    }

    /**
     * Cascade reactivate the given relationship on the given mode.
     *
     * @param string  $relationship
     *
     * @return void
     */
    protected function cascadeReactivate($relationship): void
    {
        foreach ($this->{$relationship}()->get() as $model) {
            $model->pivot ? $model->pivot->activate() : $model->activate();
        }
    }

}
