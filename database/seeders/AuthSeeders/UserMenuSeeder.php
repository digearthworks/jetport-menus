<?php

namespace Database\Seeders\AuthSeeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Turbine\Auth\Models\User;
use Turbine\Menus\Models\MenuItem;

/**
 * Class UserRoleTableSeeder.
 */
class UserMenuSeeder extends Seeder
{
    use DisableForeignKeys;

    protected $connection;

    public function __construct()
    {
        $this->connection = config('turbine.auth.connection');
    }

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run(): void
    {
        $this->disableForeignKeys($this->connection);

        $menus = MenuItem::pluck('id');

        User::find(1)->assignMenuItem($menus);

        if (app()->environment(['local', 'testing'])) {
            User::find(2)->assignMenuItem([
                MenuItem::where('handle', 'dashboard_link')->first(),
            ]);
        }



        $this->enableForeignKeys($this->connection);
    }
}
