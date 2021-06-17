<?php

namespace App\Admin\Livewire\Page;

use App\Http\Livewire\BaseDeactivateDialog;
use App\Pages\Models\Page;

class DeactivatePageDialog extends BaseDeactivateDialog
{
    protected $eloquentRepository = Page::class;

    public function deactivatePage(): void
    {
        $this->authorize('is_admin');

        $this->model->deactivate();

        $this->confirmingDeactivate = false;

        $this->emit('refreshWithSuccess', 'Page Deactivated!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.deactivate', [
            'page' => $this->model,
        ]);
    }
}
