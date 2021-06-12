<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseRestoreDialog;
use App\Models\SitePage;

class RestoreSitePageDialog extends BaseRestoreDialog
{
    public $eloquentRepository = SitePage::class;

    public function restoreSitePage()
    {
        $this->authorize('is_admin');

        $this->model->restore();

        $this->confirmingRestore = false;

        $this->emit('refreshWithSuccess', 'Page Restored!');
    }

    public function render()
    {
        return view('admin.site.pages.restore', [
            'page' => $this->model,
        ]);
    }
}
