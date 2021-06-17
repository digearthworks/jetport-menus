<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ActionMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {domain} {--invokable}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make an action class.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
