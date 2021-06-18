<?php

namespace App\Core\Admin\Livewire\Page;

use App\Core\Livewire\BaseCreateButton;

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
