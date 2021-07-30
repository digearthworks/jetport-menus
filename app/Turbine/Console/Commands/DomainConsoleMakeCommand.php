<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesDomainClass;
use Illuminate\Foundation\Console\ConsoleMakeCommand;

class DomainConsoleMakeCommand extends ConsoleMakeCommand
{
    use GeneratesDomainClass;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:domain-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a command for a domain';

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
