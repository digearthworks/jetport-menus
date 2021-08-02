<?php

namespace App\Turbine\Pages\Http\Livewire;

use App\Turbine\Concerns\InteractsWithBanner;
use App\Turbine\Livewire\BaseEditForm;
use App\Turbine\Pages\Actions\SaveAsPageAction;
use App\Turbine\Pages\Actions\UpdatePageAction;
use App\Turbine\Pages\Models\Page;
use App\Turbine\Pages\Models\PageTemplate;
use Illuminate\Support\Str;

class EditPageForm extends BaseEditForm
{
    use InteractsWithBanner;
    use SwapsTemplate;

    protected $eloquentRepository = Page::class;

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
        'title' => '',
        'slug' => '',
        'html' => '',
        'css' => '',
        'layout' => '',
        'active' => 1,
        'sort' => 0,
        'meta' => [],
    ];

    public $item;

    public $data;

    public function mount($resourceId, $params = null)
    {
        $params = (array) json_decode($params);

        $this->authorize('is_admin');

        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['title'] = $this->model->title;
        $this->state['slug'] = $this->model->slug;
        $this->state['html'] = $this->model->html;
        $this->state['css'] = $this->model->css;
        $this->state['template_id'] = $this->model->template_id;
        $this->state['layout'] = $this->model->layout;
        $this->state['active'] = $this->model->active;
        $this->state['sort'] = $this->model->sort;
        $this->state['meta'] = $this->model->meta;

        $this->dispatchBrowserEvent('showing-edit-modal');

        $this->data = $params;
    }

    public function updatePage(UpdatePageAction $updatePageAction)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();

        $updatePageAction($this->model, $this->state);

        $this->emit('refreshWithSuccess', 'Page Updated!');
        $this->banner('Page Updated');
        $this->editingResource = false;
    }

    public function savePageAs(SaveAsPageAction $saveAsPageAction)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();

        $saveAsPageAction($this->model, $this->state);

        $this->emit('refreshWithSuccess', 'Page Saved!');
        $this->banner('Page Updated');
        $this->editingResource = false;
    }

    public function sluggify()
    {
        $this->state['slug'] = Str::slug($this->state['slug']);
    }

    public function render()
    {
        $data = array_merge([
            'page' => $this->model,
            'templates' => PageTemplate::all(),
        ], $this->data ?? []);

        return view('admin.pages.edit-form', $data);
    }
}
