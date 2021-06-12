<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseEditForm;
use App\Models\SitePage;
use App\Support\Concerns\InteractsWithBanner;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Log;

class EditSitePageForm extends BaseEditForm
{
    use InteractsWithBanner;

    protected $eloquentRepository = SitePage::class;

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
        'body' => '',
        'layout' => '',
        'active' =>  1,
        'sort' =>  0,
        'meta' => [],
    ];

    public $item;

    public $data;

    public function editDialog($resourceId, $params = null)
    {
        $params = (array) json_decode($params);

        $this->authorize('is_admin');

        $this->editingResource = true;
        $this->modelId = $resourceId;
        $this->state['title'] = $this->model->title;
        $this->state['slug'] = $this->model->slug;
        $this->state['body'] = $this->model->body;
        $this->state['layout'] = $this->model->layout;
        $this->state['active'] = $this->model->active;
        $this->state['sort'] = $this->model->sort;
        $this->state['meta'] = $this->model->meta;

        $this->dispatchBrowserEvent('showing-edit-modal');

        $this->data = $params;
    }

    public function updateSitePage()
    {
        $this->authorize('is_admin');

        // dd($this->state);

        $this->resetErrorBag();
        Validator::make($this->state, [
            'title' => ['string', 'nullable'],
            'slug' => ['required', 'min:1', 'max:100', Rule::unique('site_pages')->ignore($this->modelId)],
            'body' => ['string'],
            'layout' => ['string', 'min:1', 'max:100', 'nullable'],
            'active' => ['int', 'nullable'],
            'sort' => ['int', 'nullable'],
            'meta' => ['array', 'nullable'],
        ])->validateWithBag('editMenuForm');

        try {
            $this->model->forcefill([
                'title' => $this->state['title'] ?? $this->model->title,
                'slug' => $this->state['slug'] ?? $this->model->slug,
                'body' => $this->state['body'] ?? $this->model->body,
                'layout' => $this->state['layout'] ?? $this->model->layout,
                'active' => $this->state['active'] ?? $this->model->active,
                'meta' => $this->state['meta'] ?? $this->model->meta,
            ])->save();

            if ($this->state['sort'] > 0) {
                $this->model->insertAtSortPosition($this->state['sort']);
            }
        } catch (Exception $error) {
            Log::error($error);
        }

        $this->emit('refreshWithSuccess', 'Page Updated!');
        $this->editingResource = false;
    }

    public function savePageAs()
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();
        Validator::make($this->state, [
            'title' => ['string', 'nullable'],
            'slug' => ['required', 'min:1', 'max:100', Rule::unique('site_pages')->ignore($this->modelId)],
            'body' => ['string'],
            'layout' => ['string', 'min:1', 'max:100', 'nullable'],
            'active' => ['int', 'nullable'],
            'sort' => ['int', 'nullable'],
            'meta' => ['array', 'nullable'],
        ])->validateWithBag('editMenuForm');


        $copy = $this->model->replicate();

        try {
            $copy->forcefill([
                'title' => $this->state['title'] ?? $this->model->title,
                'slug' => $this->state['slug'] === $this->model->slug ? $this->model->slug . '-copy' : $this->state['slug'],
                'body' => $this->state['body'] ?? $this->model->body,
                'layout' => $this->state['layout'] ?? $this->model->layout,
                'active' => $this->state['active'] ?? $this->model->active,
                'meta' => $this->state['meta'] ?? $this->model->meta,
            ])->save();

            if ($this->state['sort'] > 0) {
                $copy->insertAtSortPosition($this->state['sort']);
            }
        } catch (Exception $error) {
            Log::error($error);
        }


        $this->emit('refreshWithSuccess', 'Page Saved!');
        $this->editingResource = false;
    }

    public function sluggify()
    {
        $this->state['slug'] = Str::slug($this->state['slug']);
    }

    public function render()
    {
        $this->data = array_merge([
            'page' => $this->model,
        ], $this->data ?? []);

        return view('admin.site.pages.edit', $this->data);
    }
}
