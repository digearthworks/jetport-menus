<?php

namespace Database\Seeders\AuthSeeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use App\Turbine\Auth\Events\User\UserUpdated;
use App\Turbine\Auth\Models\Admin;
use ReflectionException;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleSeeder extends Seeder
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

        try {
            // Flush the Request Cache
            app()->make('cache')->store('request')->flush();
        } catch (ReflectionException $e) {
            // Do nothing
        }

        $admin = Admin::first()->assignRole(config('turbine.admin.role'));

        event(new UserUpdated($admin));

        $this->enableForeignKeys($this->connection);
    }
}
