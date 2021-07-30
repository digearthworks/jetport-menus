<?php

namespace App\Turbine\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use App\Turbine\Console\Concerns\GeneratesDomainClass;

abstract class DomainGeneratorCommand extends GeneratorCommand
{
    use GeneratesDomainClass;
}
