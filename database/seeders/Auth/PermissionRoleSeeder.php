<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    protected $connection;

    public function __construct()
    {
        $this->connection = config('domains.auth.database_connection');
    }

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys($this->connection);

        // Grouped permissions
        // Users category
        $users = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user',
            'description' => 'All User Permissions',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.list',
                'description' => 'View Users',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.deactivate',
                'description' => 'Deactivate Users',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.reactivate',
                'description' => 'Reactivate Users',
                'sort' => 3,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.clear-session',
                'description' => 'Clear User Sessions',
                'sort' => 4,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.impersonate',
                'description' => 'Impersonate Users',
                'sort' => 5,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user.change-password',
                'description' => 'Change User Passwords',
                'sort' => 6,
            ]),

        ]);

        $financial = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.financial',
            'description' => 'All Financial Permissions',
        ]);

        $financial->children()->saveMany([
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.financial.create',
                'description' => 'Can create Financial Data',
                'sort' => 7,
            ]),
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.financial.edit',
                'description' => 'Can edit Financial Data',
                'sort' => 8,
            ]),
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.financial.delete',
                'description' => 'Can delete Financial Data',
                'sort' => 9,
            ]),
        ]);

        $workforce = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.workforce',
            'description' => 'All Workforce Permissions',
        ]);

        $workforce->children()->saveMany([
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.workforce.create',
                'description' => 'Can create Workforce',
                'sort' => 10,
            ]),
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.workforce.edit',
                'description' => 'Can edit Workforce',
                'sort' => 11,
            ]),
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.workforce.delete',
                'description' => 'Can delete Workforce',
                'sort' => 12,
            ]),
        ]);

        $timetracking = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.timetracking',
            'description' => 'All Time Tracking Permissions',
        ]);

        $timetracking->children()->saveMany([
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.timetracking.edit',
                'description' => 'Can edit Time Records',
                'sort' => 13,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.timetracking.create',
                'description' => 'Can create Time Records',
                'sort' => 14,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.timetracking.create',
                'description' => 'Can delete Time Records',
                'sort' => 15,
            ]),

        ]);


        $invoices = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.invoices',
            'description' => 'All Invoice Permissions',
        ]);

        $invoices->children()->saveMany([

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.invoices.create',
                'description' => 'Can edit Invoices',
                'sort' => 16,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.invoices.edit',
                'description' => 'Can edit Invoices',
                'sort' => 17,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.invoices.delete',
                'description' => 'Can delete Invoices',
                'sort' => 18,
            ]),

        ]);

        $projects = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.projects',
            'description' => 'All Projects Permissions',
        ]);

        $projects->children()->saveMany([

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.projects.create',
                'description' => 'Can edit projects',
                'sort' => 19,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.projects.edit',
                'description' => 'Can edit projects',
                'sort' => 20,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.projects.delete',
                'description' => 'Can delete projects',
                'sort' => 21,
            ]),

        ]);

        $quotes = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.quotes',
            'description' => 'All Quotes Permissions',
        ]);

        $quotes->children()->saveMany([

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.quotes.create',
                'description' => 'Can edit quotes',
                'sort' => 22,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.quotes.edit',
                'description' => 'Can edit quotes',
                'sort' => 23,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.quotes.delete',
                'description' => 'Can delete quotes',
                'sort' => 24,
            ]),

        ]);

        $contracts = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.contracts',
            'description' => 'All Contracts Permissions',
        ]);

        $contracts->children()->saveMany([

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.contracts.create',
                'description' => 'Can edit contracts',
                'sort' => 25,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.contracts.edit',
                'description' => 'Can edit contracts',
                'sort' => 26,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.contracts.delete',
                'description' => 'Can delete contracts',
                'sort' => 27,
            ]),

        ]);

        $reports = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.reports',
            'description' => 'All Reports Permissions',
        ]);

        $reports->children()->saveMany([

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.reports.create',
                'description' => 'Can create reports',
                'sort' => 28,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.reports.edit',
                'description' => 'Can edit reports',
                'sort' => 29,
            ]),

            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.reports.delete',
                'description' => 'Can edit reports',
                'sort' => 30,
            ]),

        ]);

        $menus = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.menus',
            'description' => 'All Menu Permissions',
        ]);

        $menus->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.menus.create',
                'description' => 'Can create Menus',
                'sort' => 31,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.menus.edit',
                'description' => 'Can edit Menus',
                'sort' => 32,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.menus.delete',
                'description' => 'Can delete Menus',
                'sort' => 33,
            ]),
        ]);

        $database = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.database',
            'description' => 'All Database Permissions',
        ]);

        $database->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.database.ui',
                'description' => 'Use the database management forms',
                'sort' => 34,
            ]),
        ]);

        $adminUi = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.sidebar',
            'description' => 'Admin and Office sidebar',
        ]);

        $adminUi->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.sidebar.admin',
                'description' => 'Admin Access to Admin sidebar',
                'sort' => 35,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.sidebar.office',
                'description' => 'Admin Access to Office sidebar',
                'sort' => 36,
            ]),
        ]);

        $userUi = Permission::create([
            'type' => User::TYPE_USER,
            'name' => 'user.access.sidebar',
            'description' => 'Bookmarks And Office Sidebar Access',
        ]);

        $userUi->children()->saveMany([
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.sidebar.office',
                'description' => 'User Level Office Sidebar',
                'sort' => 37,
            ]),
            new Permission([
                'type' => User::TYPE_USER,
                'name' => 'user.access.sidebar.bookmarks',
                'description' => 'Bookmarks in the sidebar',
                'sort' => 38,
            ]),
        ]);

        $hiddenMenus = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.hidden',
            'description' => 'Access all hidden admin menus and areas',
        ]);

        $hiddenMenus->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.hidden.sidebar',
                'description' => 'Hidden sidebar links',
                'sort' => 39,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.hidden.menu-grids',
                'description' => 'Hidden controls in main menus',
                'sort' => 40,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.hidden.navbar',
                'description' => 'Hidden links in navbar',
                'sort' => 41,
            ]),
        ]);

        // Create Roles
        $superAdmin = Role::create([
            'id' => 1,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
        ]);
        $superAdmin->givePermissionTo(Permission::all());

        $auditor = Role::create([
            'id' => 2,
            'type' => User::TYPE_ADMIN,
            'name' => 'Auditor',
        ]);

        $auditor->givePermissionTo('admin.access.user');
        $auditor->givePermissionTo('user.access.financial');
        $auditor->givePermissionTo('user.access.workforce');
        $auditor->givePermissionTo('user.access.timetracking');
        $auditor->givePermissionTo('user.access.invoices');
        $auditor->givePermissionTo('user.access.projects');
        $auditor->givePermissionTo('user.access.quotes');
        $auditor->givePermissionTo('user.access.contracts');
        $auditor->givePermissionTo('user.access.reports');
        $auditor->givePermissionTo('admin.access.menus');
        $auditor->givePermissionTo('admin.access.database.ui');
        $auditor->givePermissionTo('admin.access.sidebar');
        $auditor->givePermissionTo('user.access.sidebar');

        $officer = Role::create([
            'id' => 3,
            'type' => User::TYPE_USER,
            'name' => 'Officer',
        ]);

        $officer->givePermissionTo('user.access.financial');
        $officer->givePermissionTo('user.access.workforce');
        $officer->givePermissionTo('user.access.timetracking');
        $officer->givePermissionTo('user.access.invoices');
        $officer->givePermissionTo('user.access.projects');
        $officer->givePermissionTo('user.access.quotes');
        $officer->givePermissionTo('user.access.contracts');
        $officer->givePermissionTo('admin.access.sidebar.office');
        $officer->givePermissionTo('user.access.sidebar');

        $clerk = Role::create([
            'id' => 4,
            'type' => User::TYPE_USER,
            'name' => 'Clerk',
        ]);

        $clerk->givePermissionTo('user.access.workforce');
        $clerk->givePermissionTo('user.access.timetracking');
        $clerk->givePermissionTo('user.access.invoices');
        $clerk->givePermissionTo('user.access.projects');
        $clerk->givePermissionTo('user.access.sidebar.office');
        $clerk->givePermissionTo('user.access.sidebar.bookmarks');

        $supervisor = Role::create([
            'id' => 5,
            'type' => User::TYPE_USER,
            'name' => 'Supervisor',
        ]);

        $supervisor->givePermissionTo('user.access.workforce');
        $supervisor->givePermissionTo('user.access.timetracking');
        $supervisor->givePermissionTo('user.access.invoices');
        $supervisor->givePermissionTo('user.access.projects');
        $supervisor->givePermissionTo('user.access.sidebar.bookmarks');

        $worker = Role::create([
            'id' => 6,
            'type' => User::TYPE_USER,
            'name' => 'Worker',
        ]);

        $worker->givePermissionTo('user.access.timetracking.create');

        $customer = Role::create([
            'id' => 7,
            'type' => User::TYPE_USER,
            'name' => 'Customer',
        ]);

        // Assign Permissions to other Roles
        //

        $this->enableForeignKeys($this->connection);
    }
}
