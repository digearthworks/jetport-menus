<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseDeleteDialog;
use App\Models\SitePage;

class DeleteSitePageDialog extends BaseDeleteDialog
{
    public $eloquentRepository = SitePage::class;

    public function deleteSitePage(): void
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
        return view('admin.site.pages.delete', [
            'page' => $this->model,
        ]);
    }
}
