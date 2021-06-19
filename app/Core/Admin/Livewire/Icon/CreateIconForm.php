<?php

namespace App\Core\Admin\Livewire\Icon;

use App\Core\Icons\Actions\GetIconFromInputAction;
use App\Core\Icons\Models\Icon;
use App\Core\Livewire\BaseCreateForm;
use App\Core\Livewire\Concerns\HandlesSelectIconEvent;
use App\Core\Support\Concerns\InteractsWithBanner;

class CreateIconForm extends BaseCreateForm
{
    use HandlesSelectIconEvent,
        InteractsWithBanner;

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
        'icon_id' => '',
        'name' => '',
    ];

    public $listeners = [
        'createDialog',
        'closeCreateDialog',
        'selectIcon',
    ];

    public $data;

    public $iconPreview;

    public function createDialog()
    {
        $this->authorize('admin.access.menus');

        // $this->emit('selectIcon', Icon::first()->art);

        $this->creatingResource = true;
    }

    public function createIcon(GetIconFromInputAction $getIconFromInputAction)
    {
        $this->resetErrorBag();

        $getIconFromInputAction($this->state);

        $this->emit('refreshWithSuccess', 'Icon Created!');
        $this->emit('closeCreateDialog');
        $this->creatingResource = false;
    }

    public function render()
    {
        return view('admin.icons.create', $this->data ?? []);
    }
}
