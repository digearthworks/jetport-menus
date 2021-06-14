<?php

namespace Database\Seeders\AuthSeeders;

use App\Menus\Models\Menu;
use App\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserMenuSeeder extends Seeder
{
    use DisableForeignKeys;

    protected $connection;

    public function __construct()
    {
        $this->connection = config('template.auth.database_connection');
    }

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run(): void
    {
        $this->disableForeignKeys($this->connection);

        $allMenus = Menu::whereDoesntHave('parent')->pluck('id');

        User::find(1)->assignMenu($allMenus);

        if (app()->environment(['local', 'testing'])) {
            User::find(2)->assignMenu(Menu::dashboard()->id);
        }



        $this->enableForeignKeys($this->connection);
    }
}
