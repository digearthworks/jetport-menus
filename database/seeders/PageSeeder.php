<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Turbine\Pages\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'slug' => 'welcome',
            'title' => 'Welcome to Jetport',
            'html' => file_get_contents(base_path('resources/dist/welcome.html')),
            'css' => file_get_contents(base_path('resources/dist/welcome.css')),
            'layout' => 'layouts.blank',
            'active' => 1,
        ]);

        Page::factory()->create([
            'slug' => 'example-page',
            'layout' => 'layouts.guest',
            'active' => 1,
        ]);
    }
}
