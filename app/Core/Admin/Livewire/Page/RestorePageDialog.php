<?php

namespace App\Core\Admin\Livewire\Page;

use App\Core\Livewire\BaseRestoreDialog;
use App\Core\Pages\Models\Page;

class RestorePageDialog extends BaseRestoreDialog
{
    public $eloquentRepository = Page::class;

    public function restorePage(): void
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
