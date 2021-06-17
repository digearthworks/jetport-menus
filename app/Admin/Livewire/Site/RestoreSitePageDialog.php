<?php

namespace App\Admin\Livewire\Site;

use App\Http\Livewire\BaseRestoreDialog;
use App\Pages\Models\SitePage;

class RestoreSitePageDialog extends BaseRestoreDialog
{
    public $eloquentRepository = SitePage::class;

    public function restoreSitePage(): void
    {
        $this->authorize('is_admin');

        $this->model->restore();

        $this->confirmingRestore = false;

        $this->emit('refreshWithSuccess', 'Page Restored!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.restore', [
            'page' => $this->model,
        ]);
    }
}
