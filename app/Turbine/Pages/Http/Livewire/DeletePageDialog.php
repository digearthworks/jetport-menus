<?php

namespace App\Turbine\Pages\Http\Livewire;

use App\Turbine\Livewire\BaseDeleteDialog;
use App\Turbine\Pages\Models\Page;

class DeletePageDialog extends BaseDeleteDialog
{
    public $eloquentRepository = Page::class;

    public function deletePage(): void
    {
        $this->authorize('is_admin');

        $this->model->delete();

        $this->confirmingDelete = false;
        $this->emit('refreshWithSuccess', 'Page Deleted');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.delete', [
            'page' => $this->model,
        ]);
    }
}
