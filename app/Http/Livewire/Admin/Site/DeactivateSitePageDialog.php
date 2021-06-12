<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseDeactivateDialog;
use App\Models\SitePage;

class DeactivateSitePageDialog extends BaseDeactivateDialog
{
    protected $eloquentRepository = SitePage::class;

    public function deactivateSitePage()
    {
        $this->authorize('is_admin');

        $this->model->deactivate();

        $this->confirmingDeactivate = false;

        $this->emit('refreshWithSuccess', 'Page Deactivated!');
    }

    public function render()
    {
        return view('admin.site.pages.deactivate', [
            'page' => $this->model,
        ]);
    }
}
