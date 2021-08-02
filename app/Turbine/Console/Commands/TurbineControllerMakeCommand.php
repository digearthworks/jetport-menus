<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesTurbineClass;
use Illuminate\Routing\Console\ControllerMakeCommand;

class TurbineControllerMakeCommand extends ControllerMakeCommand
{
    use GeneratesTurbineClass;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:turbo-controller';

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
