<?php

namespace App\Http\Livewire\Concerns;

trait InteractsWithDialogs
{
    public function dialog(string $verb, $resourceId = null, string $params = null)
    {
        $params = (array) json_decode($params);

        if (count($params)) {
            $this->dialogWithParams($verb, $params, $resourceId);
        } else {
            $this->emit($verb . 'Dialog', $resourceId);
        }
    }

    public function confirm(string $verb, $resourceId = null, string $params = null)
    {
        $this->emit('confirm' . ucfirst($verb), $resourceId);
    }

    private function dialogWithParams(string $verb, array $params, $resourceId = null)
    {
        $this->emit($verb . 'Dialog', $resourceId, json_encode($params));
    }
}
