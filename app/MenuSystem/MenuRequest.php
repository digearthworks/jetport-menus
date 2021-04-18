<?php

namespace App\MenuSystem;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
        parent::__construct();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'label' => ['required'],
        ];
    }
}
