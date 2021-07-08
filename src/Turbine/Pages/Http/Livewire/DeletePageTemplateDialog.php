<?php

namespace Turbine\Pages\Http\Livewire;

use Turbine\Livewire\BaseDeleteDialog;
use Turbine\Pages\Models\PageTemplate;

class DeletePageTemplateDialog extends BaseDeleteDialog
{
    public $eloquentRepository = PageTemplate::class;

    public function deletePageTemplate(): void
    {
        $this->authorize('is_admin');

        $this->model->delete();

        $this->confirmingDelete = false;
        $this->emit('refreshWithSuccess', 'Template Deleted');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.delete-template', [
            'template' => $this->model,
        ]);
    }
}
