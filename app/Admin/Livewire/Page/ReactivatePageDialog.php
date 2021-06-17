<?php

namespace App\Admin\Livewire\Page;

use App\Http\Livewire\BaseReactivateDialog;
use App\Pages\Models\Page;

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
