<?php

namespace App\Turbine\Pages\Actions;

use App\Turbine\Concerns\FiltersData;
use App\Turbine\Pages\Models\Page;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreatePageAction
{
    use FiltersData;

    public function __invoke(array $data)
    {
        $data = $this->filterData($data);

        Validator::make($data, [
            'title' => ['string', 'nullable'],
            'slug' => ['required', 'min:1', 'max:100', Rule::unique('pages')->whereNull('deleted_at')],
            'html' => ['string'],
            'css' => ['string'],
            'template_id' => ['int', 'nullable'],
            'layout' => ['string', 'min:1', 'max:100', 'nullable'],
            'active' => ['int', 'nullable'],
            'sort' => ['int', 'nullable'],
            'meta' => ['array', 'nullable'],
        ])->validateWithBag('createdPageForm');

        try {
            $page = Page::create([
                'title' => $data['title'] ?? $data['slug'],
                'slug' => $data['slug'],
                'html' => $data['html'],
                'css' => $data['css'] ?? null,
                'template_id' => $data['template_id'] ?? null,
                'layout' => $data['layout'],
                'active' => $data['active'],
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return $page;
    }
}
