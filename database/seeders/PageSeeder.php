<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Turbine\Pages\Models\Page;
use App\Turbine\Pages\Models\PageTemplate;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageTemplate::create([
            'name' => 'welcome_dist',
            'html' => file_get_contents(base_path('resources/dist/welcome.html')),
            'css' => file_get_contents(base_path('resources/dist/welcome.css')),
        ]);

        Page::create([
            'slug' => 'welcome',
            'title' => 'Welcome to Jetport',
            'html' => file_get_contents(base_path('resources/dist/welcome.html')),
            'css' => file_get_contents(base_path('resources/dist/welcome.css')),
            'layout' => 'layouts.blank',
            'active' => 1,
            'template_id' => PageTemplate::query()->where('name' , 'welcome_dist')->first()->id,
        ]);

        Page::factory()->create([
            'slug' => 'example-page',
            'layout' => 'layouts.guest',
            'active' => 1,
        ]);
    }
}
