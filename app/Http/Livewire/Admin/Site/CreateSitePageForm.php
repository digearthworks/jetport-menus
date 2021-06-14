<?php

namespace App\Http\Livewire\Admin\Site;

use App\Http\Livewire\BaseCreateForm;
use App\Pages\Models\SitePage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreateSitePageForm extends BaseCreateForm
{

    /**
     * The create form state.
     *
     * @var array
     */
    public $state= [
        'title' => '',
        'slug' => '',
        'body' => '',
        'layout' => 'layouts.guest',
        'active' =>  1,
        'meta' => [],
    ];

    public function createSitePage(): void
    {
        $this->authorize('is_admin');

        $this->resetErrorBag();

        Validator::make($this->state, [

            'title' => ['string', 'nullable'],
            'slug' => ['required', 'min:1', 'max:100', Rule::unique('site_pages')],
            'body' => ['string'],
            'layout' => ['string', 'min:1', 'max:100', 'nullable'],
            'active' => ['int', 'nullable'],
            'sort' => ['int', 'nullable'],
            'meta' => ['array', 'nullable'],

        ])->validateWithBag('createdsitePageForm');

        SitePage::create([
            'title' => $this->state['title'],
            'slug' => $this->state['slug'],
            'body' => $this->state['body'],
            'layout' => $this->state['layout'],
            'active' => $this->state['active'],
        ]);

        $this->emit('refreshWithSuccess', 'Web Page Created!');
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
        return view('admin.site.pages.create');
    }
}
