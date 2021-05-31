<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\InteractsWithDialog;
use App\Support\Concerns\InteractsWithBanner;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

/**
 * Class resourcesTable.
 */
abstract class BaseDataTable extends DataTableComponent
{
    use InteractsWithBanner,
        InteractsWithDialog;

    /**
     * @var
     */
    public $status;

    protected $listeners = [
        'refreshDatatable' => '$refresh',
        'refreshWithSuccess' => 'refreshWithSuccess'
    ];

    public function refreshWithSuccess($message)
    {
        $this->emit('refreshDatatable');
        $this->banner($message);
    }
}
