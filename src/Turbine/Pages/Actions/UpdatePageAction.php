<?php

namespace Turbine\Pages\Actions;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Turbine\Concerns\FiltersData;
use Turbine\Pages\Models\Page;

class UpdatePageAction
{
    use FiltersData;

    public function __invoke(Page $page, array $data)
    {
        $data = $this->filterData($data);

        Validator::make($data, [
            'title' => ['string', 'nullable'],
            'slug' => ['required', 'min:1', 'max:100', Rule::unique('pages')->ignore($page->id)],
            'html' => ['string'],
            'css' => ['string'],
            'template_id' => ['int', 'nullable'],
            'layout' => ['string', 'min:1', 'max:100', 'nullable'],
            'active' => ['int', 'nullable'],
            'sort' => ['int', 'nullable'],
            'meta' => ['array', 'nullable'],
        ])->validateWithBag('editMenuForm');

        try {
            $page->forcefill([
                'title' => $data['title'] ?? $page->title,
                'slug' => $data['slug'] ?? $page->slug,
                'html' => $data['html'] ?? $page->html,
                'css' => $data['css'] ?? $page->css,
                'template_id' => $data['template_id'] ?? $page->template_id,
                'layout' => $data['layout'] ?? $page->layout,
                // 'active' => $data['active'] ?? $page->active,
                'meta' => $data['meta'] ?? $page->meta,
            ])->save();

            if ($data['sort'] > 0) {
                $page->insertAtSortPosition($data['sort']);
            }

            if ((int) $data['active'] === 0) {
                $page->deactivate();
            } elseif ((int) $data['active'] === 1) {
                $page->activate();
            }
        } catch (Exception $error) {
            Log::error($error->getMessage());
        }
    }
}
