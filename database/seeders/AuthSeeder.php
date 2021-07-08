<?php

namespace Database\Seeders;

use Database\Seeders\AuthSeeders\MenuSeeder;
use Database\Seeders\AuthSeeders\PermissionRoleSeeder;
use Database\Seeders\AuthSeeders\UserMenuSeeder;
use Database\Seeders\AuthSeeders\UserRoleSeeder;
use Database\Seeders\AuthSeeders\UserSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class AuthTableSeeder.
 */
class AuthSeeder extends Seeder
{
    use DisableForeignKeys;
    use TruncateTable;

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
    public function run(): void
    {
        $this->disableForeignKeys($this->connection);

        // Reset cached roles and permissions
        Artisan::call('cache:clear');
        resolve(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->truncateMultiple([
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',
        ], $this->connection);

        $this->call(UserSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        // $this->call(MenuSeeder::class);
        $this->call(UserRoleSeeder::class);
        // $this->call(UserMenuSeeder::class);

        $this->enableForeignKeys($this->connection);

        Artisan::call('passport:client', ['--personal' => true, '--name' => 'Laravel Personal Access Client']);
    }
}
