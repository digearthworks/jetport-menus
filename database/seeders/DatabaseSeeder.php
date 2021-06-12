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

        if (app()->environment(['local', 'testing'])) {
            $this->call(ClientSeederExample::class);
            if (config('template.website.managed')) {
                $this->call(SitePageSeeder::class);
            }
            if (config('template.posts.active')) {
                $this->call(PostSeeder::class);
            }
        }
        $this->call(AuthSeeder::class);

        Model::reguard();
    }
}
