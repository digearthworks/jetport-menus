<?php

namespace Turbine\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Turbine\Console\Concerns\GeneratesDomainClass;

abstract class DomainGeneratorCommand extends GeneratorCommand
{
    use GeneratesDomainClass;
}
