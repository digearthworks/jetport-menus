<?php

namespace Turbine\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;
use Turbine\Console\Concerns\GeneratesDomainClass;

class DomainModelMakeCommand extends ModelMakeCommand
{
    use GeneratesDomainClass;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:domain-model';

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
