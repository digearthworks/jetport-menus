<?php

namespace Turbine\Pages\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Turbine\Concerns\InteractsWithBanner;
use Turbine\Livewire\BaseEditForm;
use Turbine\Pages\Models\PageTemplate;

class EditPageTemplateForm extends BaseEditForm
{
    use InteractsWithBanner;

    protected $eloquentRepository = PageTemplate::class;

    public $listeners = [
        'editDialog',
        'closeEditDialog',
    ];

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
        'name' => '',
        'html' => '',
        'css' => '',
    ];

    public $item;

    public $data;

    public function mount($resourceId, $params = null)
    {
        $params = (array) json_decode($params);

        $this->authorize('is_admin');

        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['name'] = $this->model->name;
        $this->state['html'] = $this->model->html;
        $this->state['css'] = $this->model->css;

        $this->dispatchBrowserEvent('showing-edit-modal');

        $this->data = $params;
    }

    public function updatePageTemplate()
    {
        $this->authorize('is_admin');

        // dd($this->state);

        $this->resetErrorBag();

        Validator::make($this->state, [
            'name' => ['string', 'required', Rule::unique('page_templates')->whereNull('deleted_at')->ignore($this->modelId)],
            'html' => ['string'],
            'css' => ['string', 'nullable'],
            'meta' => ['array', 'nullable'],
        ])->validateWithBag('editMenuForm');

        try {
            $this->model->forcefill([
                'name' => $this->state['name'] ?? $this->model->name,
                'html' => $this->state['html'] ?? $this->model->html,
                'css' => $this->state['css'] ?? $this->model->html,
                'meta' => $this->state['meta'] ?? $this->model->meta,
            ])->save();
        } catch (Exception $error) {
            Log::error($error->getMessage());
        }

        $this->emit('refreshWithSuccess', 'Template Updated!');
        $this->banner('Template Updated');
        $this->editingResource = false;
    }

    public function savePageTemplateAs()
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();
        Validator::make($this->state, [
            'name' => ['string', 'required', Rule::unique('page_templates')->where('deleted_at', null)->ignore($this->modelId)],
            'html' => ['string'],
            'css' => ['string'],
            'meta' => ['array', 'nullable'],
        ])->validateWithBag('editMenuForm');


        $copy = $this->model->replicate();

        try {
            $copy->forcefill([
                'name' => $this->state['name'] === $this->model->name ? $this->model->name . '-copy' : $this->state['name'],
                'html' => $this->state['html'] ?? $this->model->html,
                'css' => $this->state['css'] ?? $this->model->css,
                'meta' => $this->state['meta'] ?? $this->model->meta,
            ])->save();
        } catch (Exception $error) {
            Log::error($error->getMessage());
        }


        $this->emit('refreshWithSuccess', 'Page Saved!');
        $this->editingResource = false;
    }

    public function render()
    {
        $this->data = array_merge([
            'template' => $this->model,
        ], $this->data ?? []);

        return view('admin.pages.edit-template-form', $this->data);
    }
}
