<?php

namespace App\Http\Livewire\Admin\Icon;

use App\Http\Livewire\BaseDeleteDialog;
use App\Models\Icon;

class DeleteIconDialog extends BaseDeleteDialog
{
    public $eloquentRepository = Icon::class;

    public function deleteIcon()
    {
        $this->authorize('onlysuperadmincanddothis');

        $this->model->delete();

        $this->confirmingDelete = false;

        session()->flash('flash.banner', 'Icon Deleted!.');
        session()->flash('falsh.bannerStyle', 'success');
    }

    public function render()
    {
        return view('admin.icons.delete', [
            'icon' => $this->model,
        ]);
    }
}
