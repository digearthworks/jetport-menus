<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleSeeder extends Seeder
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

        User::find(1)->assignRole(config('domains.auth.access.role.admin'));
        User::find(2)->assignRole(config('domains.auth.access.role.admin'));
        User::find(3)->assignRole('Auditor');
        User::find(4)->assignRole('Supervisor');

        if (app()->environment(['local', 'testing'])) {
            User::find(5)->assignRole('Officer');
            User::find(6)->assignRole('Clerk');
            User::find(7)->assignRole('Worker');
        }



        $this->enableForeignKeys($this->connection);
    }
}
