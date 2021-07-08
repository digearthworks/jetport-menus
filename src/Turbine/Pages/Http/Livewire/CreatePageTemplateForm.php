<?php

namespace Turbine\Pages\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Turbine\Concerns\InteractsWithBanner;
use Turbine\Livewire\BaseCreateForm;
use Turbine\Pages\Models\PageTemplate;

class CreatePageTemplateForm extends BaseCreateForm
{
    use InteractsWithBanner;

    /**
     * The create form state.
     *
     * @var array
     */
    public $state = [
        'name' => '',
        'html' => '',
        'css' => '',
        'meta' => [],
    ];

    public function createPageTemplate()
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();

        Validator::make($this->state, [
            'name' => ['string', 'required', Rule::unique('page_templates')->whereNull('deleted_at')],
            'html' => ['string'],
            'css' => ['string'],
            'meta' => ['array', 'nullable'],
        ])->validateWithBag('createdPageForm');

        $template = PageTemplate::create([
            'name' => $this->state['name'],
            'html' => $this->state['html'],
            'css' => $this->state['css'] ?? null,
        ]);

        $this->emit('refreshWithSuccess', 'Template Created!');
        $this->creatingResource = false;

        $this->flashBanner('Template Created.');

        return redirect()->route('admin.pages.templates.edit', [ 'template' => $template]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.create-template-form');
    }
}
