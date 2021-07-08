<?php

namespace Database\Seeders;

use Artisan;
use Database\Seeders\AuthSeeders\UserMenuSeeder;
use Database\Seeders\Examples\ClientSeederExample;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (app()->environment(['local', 'testing'])) {
            $this->call(ClientSeederExample::class);
        }
        Artisan::call('buku-icons:install');
        $this->call(PageSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(AuthSeeder::class);
        $this->call(UserMenuSeeder::class);

        Model::reguard();
    }
}
