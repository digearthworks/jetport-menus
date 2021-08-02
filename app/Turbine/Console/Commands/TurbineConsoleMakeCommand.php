<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesTurbineClass;
use Illuminate\Foundation\Console\ConsoleMakeCommand;

class TurbineConsoleMakeCommand extends ConsoleMakeCommand
{
    use GeneratesTurbineClass;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:turbo-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Turbine command';

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
