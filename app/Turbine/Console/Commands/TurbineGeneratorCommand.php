<?php

namespace App\Turbine\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use App\Turbine\Console\Concerns\GeneratesTurbineClass;

abstract class TurbineGeneratorCommand extends GeneratorCommand
{
    use GeneratesTurbineClass;
}
