<?php

namespace Database\Seeders\Auth;

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
        $this->connection = config('jetport.auth.database_connection');
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
            'name' => config('jetport.auth.default_webmaster_name'),
            'email' => config('jetport.auth.default_webmaster_email'),
            'password' => config('jetport.auth.default_webmaster_password'),
            'email_verified_at' => now(),
            'active' => true,
        ]);

        // Add the owner
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => config('jetport.auth.default_site_owner_name'),
            'email' => config('jetport.auth.default_site_owner_email'),
            'password' => config('jetport.auth.default_site_owner_password'),
            'email_verified_at' => now(),
            'active' => true,
        ]);

        // Add auditor
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => config('jetport.auth.default_auditor_name'),
            'email' => config('jetport.auth.default_auditor_email'),
            'password' => config('jetport.auth.default_auditor_password'),
            'email_verified_at' => now(),
            'active' => true,
        ]);

        // Add SUPERVISOR
        User::create([
            'type' => User::TYPE_USER,
            'name' => config('jetport.auth.default_supervisor_name'),
            'email' => config('jetport.auth.default_supervisor_email'),
            'password' => config('jetport.auth.default_supervisor_password'),
            'email_verified_at' => now(),
            'active' => true,
        ]);

        if (app()->environment(['local', 'testing'])) {


                        // Add officer
            User::create([
                'type' => User::TYPE_USER,
                'name' => config('jetport.auth.default_officer_name'),
                'email' => config('jetport.auth.default_officer_email'),
                'password' => config('jetport.auth.officer_password'),
                'email_verified_at' => now(),
                'active' => true,
            ]);

            // Add clerk
            User::create([
                'type' => User::TYPE_USER,
                'name' => 'Test Clerk',
                'email' => 'clerk@clerk.com',
                'password' => 'secret',
                'email_verified_at' => now(),
                'active' => true,
            ]);
            User::create([
                'type' => User::TYPE_USER,
                'name' => 'Test Worker',
                'email' => 'worker@worker.com',
                'password' => 'secret',
                'email_verified_at' => now(),
                'active' => true,
            ]);
        }

        $this->enableForeignKeys($this->connection);
    }
}
