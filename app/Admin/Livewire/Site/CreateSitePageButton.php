<?php

namespace App\Admin\Livewire\Site;

use App\Http\Livewire\BaseCreateButton;

class CreateSitePageButton extends BaseCreateButton
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.create-page-button');
    }
}
