<?php

namespace App\Turbine\Pages\Http\Livewire;

use Livewire\Component;
use App\Turbine\Pages\Models\Page;

class Webpage extends Component
{
    public Page $page;

    public function render()
    {
        if (! $this->page->isActive()) {
            abort(404);
        }

        if ($this->page->layout == 'layouts.blank') {
            redirect($this->page->slug);
        }

        return view('pages.webpage')
            ->layout($this->page->layout ?? 'layouts.guest');
    }
}
