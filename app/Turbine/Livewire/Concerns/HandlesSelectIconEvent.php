<?php

namespace App\Turbine\Livewire\Concerns;

use HeaderX\BukuIcons\Actions\FindIconByNameOrIdAction;

trait HandlesSelectIconEvent
{
    public function selectIcon($value): void
    {
        $this->state['icon_id'] = $value;
        $this->reloadIconPreview();
    }

    public function reloadIconPreview(): void
    {
        $this->iconPreview = ((new FindIconByNameOrIdAction)($this->state['icon_id']))->name ?? 'carbon-no-image-32';
    }
}
