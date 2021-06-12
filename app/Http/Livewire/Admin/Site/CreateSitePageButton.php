<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseCreateButton;

class CreateSitePageButton extends BaseCreateButton
{
    public function render()
    {
        return view('admin.site.pages.includes.partials.create-site-page-button');
    }
}
