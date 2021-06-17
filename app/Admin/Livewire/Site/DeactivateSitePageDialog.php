<?php

namespace App\Admin\Livewire\Site;

use App\Http\Livewire\BaseDeactivateDialog;
use App\Pages\Models\SitePage;

class DeactivateSitePageDialog extends BaseDeactivateDialog
{
    protected $eloquentRepository = SitePage::class;

    public function deactivateSitePage(): void
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
        return view('admin.site.pages.deactivate', [
            'page' => $this->model,
        ]);
    }
}
