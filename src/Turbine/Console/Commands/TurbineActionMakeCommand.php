<?php

namespace Turbine\Console\Commands;

class TurbineActionMakeCommand extends TurbineGeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:turbo-action';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an invokable class.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('stubs/action.invokable.stub');
    }
}
