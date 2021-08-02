<?php

namespace App\Turbine\Console\Commands;

use App\Turbine\Console\Concerns\GeneratesDomainClass;
use Illuminate\Console\GeneratorCommand;

abstract class DomainGeneratorCommand extends GeneratorCommand
{
    use GeneratesDomainClass;
}
