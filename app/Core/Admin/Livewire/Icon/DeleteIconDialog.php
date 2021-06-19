<?php

namespace App\Core\Admin\Livewire\Icon;

use App\Core\Icons\Models\Icon;
use App\Core\Livewire\BaseDeleteDialog;

class DeleteIconDialog extends BaseDeleteDialog
{
    public $eloquentRepository = Icon::class;

    public function deleteIcon(): void
    {
        $this->authorize('onlysuperadmincanddothis');

        $this->model->delete();

        $this->confirmingDelete = false;

        session()->flash('flash.banner', 'Icon Deleted!.');
        session()->flash('falsh.bannerStyle', 'success');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.icons.delete', [
            'icon' => $this->model,
        ]);
    }
}
