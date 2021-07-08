<?php

namespace Turbine\Pages\Http\Livewire;

use Turbine\Livewire\BaseCreateButton;

class CreatePageButton extends BaseCreateButton
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.create-page-button');
    }
}
