<?php

namespace App\Http\Livewire;

use App\Pages\Models\SitePage;
use Livewire\Component;

class Webpage extends Component
{
    public SitePage $page;

    public function render()
    {
        if (!$this->page->isActive()) {
            abort(404);
        }
        return view('webpage')
            ->layout($this->page->layout ?? 'layouts.guest');
    }
}
