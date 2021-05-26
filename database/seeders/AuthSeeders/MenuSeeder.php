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
            'icon_id' => '<svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
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
            'icon_id' => '<svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
        ]);

        $system = Menu::create([
            'group' => 'admin',
            'name' => 'System',
            'type' => 'main_menu',
            'title' => 'System Menu',
            'active' => 1,
            'iframe' => 0,
            'row' => null,
            'menu_id' => null,
            'icon_id' => '<svg class="h-4" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
            viewBox="0 0 285 285" style="enable-background:new 0 0 285 285;" xml:space="preserve">
       <path d="M227.5,20c0-11.046-8.954-20-20-20h-130c-11.046,0-20,8.954-20,20v245c0,11.046,8.954,20,20,20h130c11.046,0,20-8.954,20-20
           V20z M201.5,249h-118v-25h118V249z M134.348,129.52c0-7.048,5.714-12.762,12.762-12.762c7.048,0,12.762,5.714,12.762,12.762
           c0,7.048-5.714,12.762-12.762,12.762C140.062,142.282,134.348,136.568,134.348,129.52z M173.336,129.52
           c0-7.048,5.714-12.762,12.762-12.762c7.048,0,12.762,5.714,12.762,12.762c0,7.048-5.714,12.762-12.762,12.762
           C179.049,142.282,173.336,136.568,173.336,129.52z M201.5,94h-118V68h118V94z M201.5,48h-118V22h118V48z"/>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       <g>
       </g>
       </svg>
       ',
        ]);

        $system->children()->saveMany([
            new Menu([
                'group' => 'main',
                'name' => 'Logs Dashboard',
                'link' => '/admin/log-viewer',
                'type' => 'internal_link',
                'title' => 'Link to the Log Viewer Dashboard',
                'active' => 1,
                'iframe' => 1,
                'icon_id' => 'fas fa-tachometer-alt',
            ]),
            new Menu([
                'group' => 'main',
                'name' => 'Logs',
                'link' => '/admin/log-viewer/logs',
                'type' => 'internal_link',
                'title' => 'Link to the Logs table',
                'active' => 1,
                'iframe' => 1,
                'icon_id' => '<svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>',
            ]),
        ]);

        $this->enableForeignKeys($this->connection);
    }
}
