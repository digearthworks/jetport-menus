<?php

namespace App\Turbine\Livewire\Concerns;

trait InteractsWithDialog
{
    public function dialog(string $verb, $resourceId = null, string $params = null): void
    {
        $params = (array) json_decode($params);

        if (count($params)) {
            $this->dialogWithParams($verb, $params, $resourceId);
        } else {
            $this->emit($verb . 'Dialog', $resourceId);
        }
    }

    public function confirm(string $verb, $resourceId = null, string $params = null): void
    {
        $this->emit('confirm' . ucfirst($verb), $resourceId);
    }

    private function dialogWithParams(string $verb, array $params, $resourceId = null): void
    {
        $this->emit($verb . 'Dialog', $resourceId, json_encode($params));
    }
}
