<?php

namespace App\Http\Livewire;

class CreateMenuButton extends CreateButton
{
    public function mount($value = null)
    {
        if($value){
            $this->value = $value;
        }
    }
}
