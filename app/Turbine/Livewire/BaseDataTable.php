<?php

namespace App\Turbine\Livewire;

use App\Turbine\Concerns\InteractsWithBanner;
use App\Turbine\Livewire\Concerns\InteractsWithDialog;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

/**
 * Class resourcesTable.
 */
abstract class BaseDataTable extends DataTableComponent
{
    use InteractsWithBanner;
    use InteractsWithDialog;

    /**
     * @var
     */
    public $status;

    protected $listeners = [
        'refreshDatatable' => '$refresh',
        'refreshWithSuccess' => 'refreshWithSuccess',
    ];

    public function refreshWithSuccess($message): void
    {
        $this->emit('refreshDatatable');
        $this->banner($message);
    }
}
