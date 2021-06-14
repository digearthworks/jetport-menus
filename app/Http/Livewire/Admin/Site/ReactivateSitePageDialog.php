<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseReactivateDialog;
use App\Pages\Models\SitePage;

class ReactivateSitePageDialog extends BaseReactivateDialog
{
    public $eloquentRepository = SitePage::class;

    public function reactivateSitePage(): void
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
        return view('admin.site.pages.reactivate', [
            'page' => $this->model,
        ]);
    }
}
