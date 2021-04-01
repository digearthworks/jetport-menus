<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add the master administrator, user id of 1
        User::create([
            'name' => config('domains.auth.default_webmaster_name'),
            'email' => config('domains.auth.default_webmaster_email'),
            'password' => config('domains.auth.default_webmaster_password'),
            'email_verified_at' => now(),
        ]);
        Artisan::call('passport:client', ['--personal' => true, '--name' => 'Laravel Personal Access Client']);
    }
}
