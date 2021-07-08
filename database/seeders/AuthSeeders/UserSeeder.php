<?php

namespace Database\Seeders\AuthSeeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\Models\Admin;
use Turbine\Auth\Models\User;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
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

        // Add the master administrator, user id of 1
        Admin::create([
            'type' => UserTypeEnum::admin(),
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        if (app()->environment(['local', 'testing'])) {
            User::create([
                'type' => UserTypeEnum::user(),
                'name' => 'Test User',
                'email' => 'user@user.com',
                'password' => 'secret',
                'email_verified_at' => now(),
                'active' => true,
            ]);
        }

        $this->enableForeignKeys($this->connection);
    }
}
