<?php

namespace App\Http\Livewire;

use App\Services\MenuService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CreateMenu extends Component
{
    use AuthorizesRequests,
        InteractsWithBanner;

    public $creating = false;

    /**
     * The create form state.
     *
     * @var array
     */
    public $form = [
        'group' => '',
        'name' => '',
        'link' => '',
        'type' => '',
        'active' => '1',
        'title' => '',
        'iframe' => '0',
        'sort' => '',
        'row' => '',
        'menu_id' => '',
        'icon' => '',
    ];

    public $data;

    public $listeners = ['openCreateDialog'];

    public function openCreateDialog($params)
    {
        $this->authorize('admin.access.menus');

        $this->creating = true;

        $this->data = $params;

    }

    public function create(MenuService $menus)
    {
        $this->resetErrorBag();

        Validator::make($this->form, [
            'group' => ['string', 'required'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'active' => ['int'],
            'title' => ['string'],
            'iframe' => ['int'],
            'sort' => ['int'],
            'menu_id' => ['int'],
        ])->validateWithBag('createMenuForm');
            // dd($this->form);
        $menus->store($this->form);
        $this->emit('created');
        $this->emit('closeCreateDialog');
        $this->creating = false;
    }

    public function closeCreateDialog()
    {
        $this->creating = false;
        $this->emit('closeCreateDialog');
    }

    public function render()
    {
        return view('admin.menus.create', $this->data??[]);
    }
}
