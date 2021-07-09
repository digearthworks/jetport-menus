<?php

namespace Turbine\Menus\Http\Livewire\Admin;

use HeaderX\BukuIcons\Http\Livewire\IconSearch;
use HeaderX\BukuIcons\Models\Icon;
use HeaderX\BukuIcons\Models\IconSet;
use Illuminate\Contracts\View\View;

class IconSelect extends IconSearch
{
   
    public function render(): View
    {
        return view('admin.menus.select-icon', [
            'total' => Icon::query()->withSet($this->set)->count(),
            'icons' => $this->icons(),
            'sets' => IconSet::orderBy('name')->get(),
        ]);
    }
}
