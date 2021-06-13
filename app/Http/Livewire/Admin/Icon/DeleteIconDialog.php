<?php

namespace App\Http\Livewire\Admin\Icon;

use App\Http\Livewire\BaseDeleteDialog;
use App\Models\Icon;

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
