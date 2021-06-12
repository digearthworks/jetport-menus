<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseDeleteDialog;
use App\Models\SitePage;

class DeleteSitePageDialog extends BaseDeleteDialog
{
    public $eloquentRepository = SitePage::class;

    public function deleteSitePage()
    {
        $this->authorize('is_admin');

        $this->model->delete();

        $this->confirmingDelete = false;
        $this->emit('refreshWithSuccess', 'Page Deleted');
    }

    public function render()
    {
        return view('admin.site.pages.delete', [
            'page' => $this->model,
        ]);
    }
}
