<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesTurbineClass;
use Illuminate\Console\GeneratorCommand;

abstract class TurbineGeneratorCommand extends GeneratorCommand
{
    use GeneratesTurbineClass;
}
