<?php

namespace App\Turbine\Pages\Http\Livewire;

use App\Turbine\Livewire\BaseReactivateDialog;
use App\Turbine\Pages\Models\Page;

class ReactivatePageDialog extends BaseReactivateDialog
{
    public $eloquentRepository = Page::class;

    public function reactivatePage(): void
    {
        $this->authorize('is_admin');

        $this->model->activate();

        $this->confirmingReactivate = false;

        $this->emit('refreshWithSuccess', 'Page Reactivated!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.reactivate', [
            'page' => $this->model,
        ]);
    }
}
