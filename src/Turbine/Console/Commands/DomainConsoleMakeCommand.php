<?php

namespace Turbine\Console\Commands;

use Illuminate\Foundation\Console\ConsoleMakeCommand;
use Turbine\Console\Concerns\GeneratesDomainClass;

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
