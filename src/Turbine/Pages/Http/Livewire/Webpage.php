<?php

namespace Turbine\Pages\Http\Livewire;

use Livewire\Component;
use Turbine\Pages\Models\Page;

class Webpage extends Component
{
    public Page $page;

    public function render()
    {
        if (! $this->page->isActive()) {
            abort(404);
        }

        if ($this->page->layout == 'layouts.blank') {
           return redirect($this->page->slug);
        }

        return view('pages.webpage')
            ->layout($this->page->layout ?? 'layouts.guest');
    }
}
