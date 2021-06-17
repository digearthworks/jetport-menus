<?php

namespace App\Admin\Livewire\Icon;

use App\Http\Livewire\BaseCreateForm;
use App\Http\Livewire\Concerns\HandlesSelectIconEvent;
use App\Icons\Actions\GetIconFromInputAction;
use App\Icons\Models\Icon;
use App\Support\Concerns\InteractsWithBanner;
use Illuminate\Support\Facades\Validator;

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

        Validator::make($this->state, [
            'meta' => ['string', 'nullable'],
        ])->validateWithBag('createIconForm');

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
