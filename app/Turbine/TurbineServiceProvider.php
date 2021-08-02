<?php

namespace App\Turbine;

use App\Turbine\Console\Commands\DomainActionMakeCommand;
use App\Turbine\Console\Commands\DomainCastMakeCommand;
use App\Turbine\Console\Commands\DomainConsoleMakeCommand;
use App\Turbine\Console\Commands\DomainControllerMakeCommand;
use App\Turbine\Console\Commands\DomainModelMakeCommand;
use App\Turbine\Console\Commands\TurbineActionMakeCommand;
use App\Turbine\Console\Commands\TurbineCastMakeCommand;
use App\Turbine\Console\Commands\TurbineConsoleMakeCommand;
use App\Turbine\Console\Commands\TurbineControllerMakeCommand;
use App\Turbine\Console\Commands\TurbineModelMakeCommand;
use Illuminate\Support\ServiceProvider;

class TurbineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootComponents();
        $this->bootComposer();
    }

    public function register()
    {
        $this->registerLivewire();
        $this->registerCommands();
    }

    private function bootComponents()
    {
        //
    }

    private function bootComposer()
    {
        //
    }

    private function registerLivewire()
    {
        //
    }

    protected function registerCommands()
    {
        $this->commands([
            TurbineActionMakeCommand::class,
            TurbineCastMakeCommand::class,
            TurbineControllerMakeCommand::class,
            TurbineModelMakeCommand::class,
            TurbineConsoleMakeCommand::class,
            DomainActionMakeCommand::class,
            DomainCastMakeCommand::class,
            DomainControllerMakeCommand::class,
            DomainModelMakeCommand::class,
            DomainConsoleMakeCommand::class,
            // MenuModelMakeCommand::class,
        ]);
    }
}
