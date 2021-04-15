<?php

namespace Database\Seeders;

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

        $this->call(AuthSeeder::class);

        if (app()->environment(['local', 'testing'])) {
            $this->call(ClientSeederExample::class);
            if (config('jetport.posts.active')) {
                $this->call(PostSeeder::class);
            }
        }

        Model::reguard();
    }
}
