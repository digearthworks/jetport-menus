<?php

namespace App\Admin\Livewire\Page;

use App\Http\Livewire\BaseCreateButton;

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
