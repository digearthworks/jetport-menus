<?php

namespace App\Admin\Livewire\Icon;

use App\Http\Livewire\BaseEditForm;
use App\Http\Livewire\Concerns\HandlesSelectIconEvent;
use App\Icons\Actions\GetIconFromInputAction;
use App\Icons\Models\Icon;
use App\Support\Concerns\InteractsWithBanner;
use Illuminate\Support\Facades\Validator;

class EditIconForm extends BaseEditForm
{
    use HandlesSelectIconEvent,
        InteractsWithBanner;

    protected $eloquentRepository = Icon::class;

    public $iconPreview;

    public $listeners = [
        'editDialog',
        'closeEditDialog',
        'selectIcon',
    ];

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
        'icon_id' => '',
        'name' => '',
    ];

    public function editDialog($resourceId, $params = null)
    {
        $params = (array) json_decode($params);

        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['name'] = $this->model->meta;
        $this->state['icon_id'] = $this->model->input;
        $this->iconPreview = $this->model->art;
        $this->dispatchBrowserEvent('showing-edit-modal');
    }

    public function updateIcon(GetIconFromInputAction $getIconFromInputAction)
    {
        $this->authorize('is_admin');
        $this->resetErrorBag();

        Validator::make($this->state, [
            'name' => ['string', 'nullable'],
        ])->validateWithBag('createIconForm');

        $this->state['name'] = str_replace($this->model->meta, '', $this->state['name']);

        $getIconFromInputAction($this->state);

        $this->emit('refreshWithSuccess', 'Menu Updated!');
        $this->emit('refreshMenuGrid');
        $this->banner('Menu Updated');
        $this->editingResource = false;
    }

    public function closeEditDialog()
    {
        $this->editing = false;
        $this->emit('closeEditDialog');
    }

    public function render()
    {
        return view('admin.icons.edit');
    }
}
