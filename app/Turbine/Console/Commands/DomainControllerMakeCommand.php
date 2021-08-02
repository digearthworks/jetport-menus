<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesDomainClass;
use Illuminate\Routing\Console\ControllerMakeCommand;

class DomainControllerMakeCommand extends ControllerMakeCommand
{
    use GeneratesDomainClass;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:domain-controller';

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
