<?php

namespace App\Core\Admin\Livewire\Icon;

use App\Core\Icons\Models\Icon;
use App\Core\Support\FontAwesome;
use Livewire\Component;

class IconSelect extends Component
{
    public $query;
    public $icons;
    public $iconSource;

    public function mount(): void
    {
        $fontAwesomeIcons = FontAwesome::all();

        $icons = Icon::all();

        $this->iconSource = collect($icons)->merge(collect($fontAwesomeIcons));
        $this->icons = $this->iconSource;
    }

    public function updatedQuery(): void
    {
        $query = $this->query;

        $this->icons = $this->iconSource->filter(function ($icon, $key) use ($query) {
            return str_contains($icon['class'] ?? '', $query) ||
                str_contains($icon['html'] ?? '', $query) ||
                str_contains($icon['meta'] ?? '', $query) ||
                str_contains($icon['source'] ?? '', $query);
        });
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.icons.icon-select');
    }
}
