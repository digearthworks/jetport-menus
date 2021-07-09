<?php

namespace Tests;

use Database\Seeders\AuthSeeder;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Turbine\Auth\Models\Role;
use Turbine\Auth\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed', ['--class' => AuthSeeder::class]);

        $this->withoutMiddleware(RequirePassword::class);
    }

    protected function getAdminRole()
    {
        return Role::find(1);
    }

    protected function getMasterAdmin()
    {
        return User::find(1);
    }

    protected function loginAsAdmin($admin = false)
    {
        if (! $admin) {
            $admin = $this->getMasterAdmin();
        }

        $this->actingAs($admin);

        return $admin;
    }

    protected function logout()
    {
        return Auth::logout();
    }

    protected function loginWithAssignedPermission(string $permission, $user = null)
    {
        $user = $user ?? User::factory()->create();

        $user->givePermissionTo($permission);

        $this->actingAs($user);

        return $user;
    }
}
