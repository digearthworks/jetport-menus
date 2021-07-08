<?php

namespace Turbine\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Turbine\Concerns\InteractsWithBanner;
use Turbine\Livewire\Concerns\InteractsWithDialog;

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
