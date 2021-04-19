<?php

namespace App\Http\Livewire\Datatables;

use App\Http\Livewire\Datatables\Traits\HtmlComponents;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

/**
 * The base table for all of the datatables
 * in the application
 */
abstract class BaseTable extends LivewireDatatable
{
    use HtmlComponents;

    public $editsUsers = false;
}
