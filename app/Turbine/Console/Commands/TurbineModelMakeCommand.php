<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesTurbineClass;
use Illuminate\Foundation\Console\ModelMakeCommand;

class TurbineModelMakeCommand extends ModelMakeCommand
{
    use GeneratesTurbineClass;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:turbo-model';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }
}
