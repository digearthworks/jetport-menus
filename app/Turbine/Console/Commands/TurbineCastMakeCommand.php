<?php

namespace App\Turbine\Console\Commands;

class TurbineCastMakeCommand extends TurbineGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:turbo-cast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new custom Eloquent cast class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Cast';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/cast.stub');
    }
}
