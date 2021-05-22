<?php

namespace Database\Seeders\AuthSeeders;

use App\Models\Menu;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    use DisableForeignKeys;

    protected $connection;

    public function __construct()
    {
        $this->connection = config('template.auth.database_connection');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys($this->connection);

        Menu::create([
            'group' => 'app',
            'name' => 'Dashboard',
            'link' => '/dashboard',
            'type' => 'internal_link',
            'title' => 'Link to the Dashboard',
            'active' => 1,
            'iframe' => 0,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'fas fa-tachometer-alt',
        ]);

        Menu::create([
            'group' => 'admin',
            'name' => 'Menu Management',
            'link' => '/admin/auth/menus',
            'type' => 'internal_link',
            'title' => 'Link to the Menu Manager',
            'active' => 1,
            'iframe' => 0,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'far fa-list-alt',
        ]);

        Menu::create([
            'group' => 'admin',
            'name' => 'User Management',
            'link' => '/admin/auth/users',
            'type' => 'internal_link',
            'title' => 'Link to the User Manager',
            'active' => 1,
            'iframe' => 0,
            'row' => null,
            'menu_id' => null,
            'icon_id' => '<svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
        ]);

        Menu::create([
            'group' => 'admin',
            'name' => 'Role Management',
            'link' => '/admin/auth/roles',
            'type' => 'internal_link',
            'title' => 'Link to the Role Manager',
            'active' => 1,
            'iframe' => 0,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'fas fa-paint-roller',
        ]);


        $this->enableForeignKeys($this->connection);
    }
}
