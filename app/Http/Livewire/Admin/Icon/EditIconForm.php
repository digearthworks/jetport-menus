<?php

namespace App\Http\Livewire\Admin\Icon;

use App\Http\Livewire\BaseEditForm;
use App\Http\Livewire\Concerns\HandlesSelectIconEvent;
use App\Models\Icon;
use App\Services\Icon\IconService;
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

    public function updateIcon(IconService $icons)
    {
        $this->authorize('is_admin');
        $this->resetErrorBag();

        Validator::make($this->state, [
            'name' => ['string', 'nullable'],
        ])->validateWithBag('createIconForm');

        $this->state['name'] = str_replace($this->model->meta, '', $this->state['name']);

        $icons->createFromInput($this->state);

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
