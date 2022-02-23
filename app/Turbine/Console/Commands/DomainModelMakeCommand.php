<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesDomainClass;
use Illuminate\Foundation\Console\ModelMakeCommand;

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
