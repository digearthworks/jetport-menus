<?php

namespace App\Http\Livewire;

use App\Core\Pages\Models\Page;
use Livewire\Component;

class Webpage extends Component
{
    public Page $page;

    public function render()
    {
        if (!$this->page->isActive()) {
            abort(404);
        }
        return view('livewire.webpage')
            ->layout($this->page->layout ?? 'layouts.guest');
    }
}
