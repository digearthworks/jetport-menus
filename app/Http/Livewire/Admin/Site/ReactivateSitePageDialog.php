<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseReactivateDialog;
use App\Models\SitePage;

class ReactivateSitePageDialog extends BaseReactivateDialog
{
    public $eloquentRepository = SitePage::class;

    public function reactivateSitePage()
    {
        $this->authorize('is_admin');

        $this->model->activate();

        $this->confirmingReactivate = false;

        $this->emit('refreshWithSuccess', 'Page Reactivated!');
    }

    public function render()
    {
        return view('admin.site.pages.reactivate', [
            'page' => $this->model,
        ]);
    }
}
