<?php

namespace Database\Seeders\AuthSeeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserSeeder extends Seeder
{
    use DisableForeignKeys;

    protected $connection;

    public function __construct()
    {
        $this->connection = config('template.auth.database_connection');
    }

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys($this->connection);

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        if (app()->environment(['local', 'testing'])) {
            User::create([
                'type' => User::TYPE_USER,
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
