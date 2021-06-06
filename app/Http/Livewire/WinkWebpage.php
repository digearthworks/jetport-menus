<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Wink\WinkPage;

class WinkWebpage extends Component
{
    public WinkPage $page;

    public function render()
    {
        return view('webpage')
            ->layout(config('template.cms.page_layout'));
    }
}
