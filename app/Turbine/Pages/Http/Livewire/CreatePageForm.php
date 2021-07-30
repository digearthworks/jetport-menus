<?php

namespace App\Turbine\Pages\Http\Livewire;

use App\Turbine\Concerns\FlashesBanner;
use App\Turbine\Livewire\BaseCreateForm;
use App\Turbine\Pages\Actions\CreatePageAction;
use App\Turbine\Pages\Models\PageTemplate;
use Illuminate\Support\Str;

class CreatePageForm extends BaseCreateForm
{
    use SwapsTemplate;
    use FlashesBanner;

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
        'template_id' => '',
        'layout' => 'layouts.guest',
        'active' => 1,
        'meta' => [],
    ];

    public function createPage(CreatePageAction $createPageAction)
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();

        $page = $createPageAction($this->state);

        $this->emit('refreshWithSuccess', 'Web Page Created!');

        $this->flashBanner('Page Created');

        return redirect()->route('admin.pages.edit', ['page' => $page]);

        $this->creatingResource = false;
    }

    public function sluggify(): void
    {
        $this->state['slug'] = Str::slug($this->state['slug']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin.pages.create-form', [
            'templates' => PageTemplate::all(),
        ]);
    }
}
