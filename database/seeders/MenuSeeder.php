<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Turbine\Icons\Models\Icon;
use Turbine\Menus\Enums\MenuItemTargetEnum;
use Turbine\Menus\Enums\MenuItemTemplateEnum;
use Turbine\Menus\Enums\MenuItemTypeEnum;
use Turbine\Menus\Enums\MenuTemplateEnum;
use Turbine\Menus\Enums\MenuTypeEnum;
use Turbine\Menus\Models\InternalIframe;
use Turbine\Menus\Models\InternalLink;
use Turbine\Menus\Models\Menu;
use Turbine\Menus\Models\MenuItem;
use Turbine\Menus\Models\PageLink;
use Turbine\Pages\Models\Page;

class MenuSeeder extends Seeder
{
    use DisableForeignKeys;

    protected $connection;

    public function __construct()
    {
        $this->connection = config('turbine.auth.connection');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys($this->connection);

        $userMenu = Menu::create([
            'title' => 'Default User Menu',
            'name' => 'User',
            'handle' => 'default_user_menu',
            'type' => MenuTypeEnum::user(),
            'active' => true,
            'template' => MenuTemplateEnum::default(),
        ]);

        // $user = $userMenu->menuItems()->create([
        //     'type' => MenuItemTypeEnum::menu_link(),
        //     'template' => MenuItemTemplateEnum::default(),
        //     'target' => MenuItemTargetEnum::self(),
        //     'name' => 'Quick Links',
        //     'handle' => 'quick_links',
        //     'active' => true,
        //     'title' => 'Quick Links',
        // ]);

        // $userLinks = $user->internalLink()->saveMany([

        //     new InternalLink([
        //         'template' => MenuItemTemplateEnum::default(),
        //         'target' => MenuItemTargetEnum::self(),
        //         'route' => 'dashboard',
        //         'name' => 'Dashboard',
        //         'handle' => 'dashboard',
        //         'uri' => '/dashboard',
        //         'active' => true,
        //         'title' => 'Dashboard',
        //         'icon_id' => 'fas fa-tachometer-alt',
        //     ]),


        // ]);

        $dashboard = $userMenu->menuItems()->create([
            'type' => MenuItemTypeEnum::internal_link(),
            'template' => MenuItemTemplateEnum::default(),
            'target' => MenuItemTargetEnum::self(),
            'route' => 'dashboard',
            'name' => 'Dashboard',
            'handle' => 'dashboard_link',
            'uri' => '/dashboard',
            'active' => true,
            'title' => 'Dashboard',
            'icon_id' => 'fas-tachometer-alt',
        ]);

        $guestMenu = Menu::create([
            'title' => 'Default Guest Menu',
            'name' => 'Guest',
            'handle' => 'default_guest_menu',
            'type' => MenuTypeEnum::guest(),
            'active' => true,
            'template' => MenuTemplateEnum::default(),
        ]);

        $guest = $guestMenu->menuItems()->create([
            'type' => MenuItemTypeEnum::menu_link(),
            'template' => MenuItemTemplateEnum::default(),
            'target' => MenuItemTargetEnum::self(),
            'name' => 'Guest Links',
            'handle' => 'guest_links',
            'active' => true,
            'title' => 'Guest Links',
            'icon_id' => 'no image'
        ]);

        $guestLinks = $guest->pageLinks()->saveMany([

            new PageLink([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'name' => 'Example Page',
                'handle' => 'example_page',
                'active' => true,
                'title' => 'Link to the Example Page',
                'icon_id' => 'carbon-no-image-32',
                'page_id' => Page::where('slug', 'example-page')->first()->id,
            ]),
        ]);

        $adminMenu = Menu::create([
            'title' => 'Admin',
            'name' => 'Admin',
            'handle' => 'default_admin_menu',
            'type' => MenuTypeEnum::admin(),
            'active' => true,
            'template' => MenuTemplateEnum::default(),
        ]);

        $access = $adminMenu->menuItems()->create([
            'type' => MenuItemTypeEnum::menu_link(),
            'template' => MenuItemTemplateEnum::default(),
            'target' => MenuItemTargetEnum::self(),
            'name' => 'Access',
            'handle' => 'access_mangement',
            'active' => true,
            'title' => 'Access',
            'icon_id' => 'heroicon-o-key',
        ]);

        $adminAccessLinks = $access->internalLink()->saveMany([

            new InternalLink([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'route' => 'admin.users',
                'name' => 'Users',
                'handle' => 'user_manager',
                'uri' => '/admin/users',
                'active' => true,
                'title' => 'Icons',
                'icon_id' => 'heroicon-o-user',
            ]),

            new InternalLink([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'route' => 'admin.roles',
                'name' => 'Roles',
                'handle' => 'role_manager',
                'uri' => '/admin/roles',
                'active' => true,
                'title' => 'Roles',
                'icon_id' => 'heroicon-o-users',
            ]),
        ]);

        $content = $adminMenu->menuItems()->create([
            'type' => MenuItemTypeEnum::menu_link(),
            'template' => MenuItemTemplateEnum::default(),
            'target' => MenuItemTargetEnum::self(),
            'name' => 'Content',
            'handle' => 'content_mangement',
            'active' => true,
            'title' => 'Content',
            'icon_id' => 'fluentui-content-settings-20-o',
        ]);

        $contentLinks = $content->internalLink()->saveMany([

            new InternalLink([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'route' => 'admin.menus',
                'name' => 'Menus',
                'handle' => 'menu_manager',
                'uri' => '/admin/menus',
                'active' => true,
                'title' => 'Menus',
                'icon_id' => 'sui-circle-menu',
            ]),

            new InternalIframe([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'name' => 'Icons',
                'handle' => 'icon_manager',
                'uri' => '/blade-icons',
                'active' => true,
                'title' => 'Icons',
                'icon_id' => 'fas-icons',
            ]),

            new InternalLink([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'route' => 'admin.pages',
                'name' => 'Pages',
                'handle' => 'page_manager',
                'uri' => '/admin/pages',
                'active' => true,
                'title' => 'Pages',
                'icon_id' => 'fluentui-design-ideas-20-o',
            ]),
        ]);


        $system = $adminMenu->menuItems()->create([
            'type' => MenuItemTypeEnum::menu_link(),
            'template' => MenuItemTemplateEnum::default(),
            'target' => MenuItemTargetEnum::self(),
            'name' => 'System',
            'handle' => 'default_system_menu',
            'active' => true,
            'title' => 'System Menu',
            'icon_id' => 'clarity-server-line',
        ]);

        $systemLinks = $system->internalIframes()->saveMany([
            new InternalIframe([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'name' => 'Database',
                'handle' => 'adminer_link',
                'uri' => '/adminer',
                'active' => true,
                'title' => 'Link to adminer',
                'icon_id' => 'iconoir-database-settings',
            ]),
            new InternalIframe([
                'template' => MenuItemTemplateEnum::default(),
                'target' => MenuItemTargetEnum::self(),
                'name' => 'Logs',
                'handle' => 'system_logs',
                'uri' => '/admin/log-viewer/logs',
                'active' => true,
                'title' => 'Link to the Logs table',
                'icon_id' => 'iconpark-log',
            ]),
        ]);


        MenuItem::setNewOrder([
            $dashboard->id,
            $access->id,
            $content->id,
            $system->id,
            // $user->id,
            $guest->id,
        ]);

        Menu::setNewOrder([
            $userMenu->id,
            $adminMenu->id,
            $guestMenu->id,
        ]);

        $this->enableForeignKeys($this->connection);
    }
}
