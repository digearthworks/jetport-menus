<?php

namespace App\Http\Livewire\Concerns;

use App\Models\Icon;
use App\Services\Icon\FontAwesome;

trait HandlesSelectIconEvent
{
    public function selectIcon($value)
    {
        $this->state['icon_id'] = $value;
        $this->reloadIconPreview();
    }

    public function reloadIconPreview()
    {
        $this->iconPreview = (!FontAwesome::wantsFontAwesome($this->state['icon_id'])) ? (new Icon([
            'html' => $this->state['icon_id'],
            'source' => 'raw',
        ]))->art : (new Icon([
            'class' => $this->state['icon_id'],
            'source' => 'FontAwesome',
            'version' => '5',
        ]))->art;
    }
}
