<?php

namespace Turbine\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Turbine\Console\Concerns\GeneratesTurbineClass;

abstract class TurbineGeneratorCommand extends GeneratorCommand
{
    use GeneratesTurbineClass;
}
