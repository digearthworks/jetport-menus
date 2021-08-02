<?php

namespace Tests\Feature\Page\Admin;

use App\Turbine\Pages\Http\Livewire\CreatePageForm;
use App\Turbine\Pages\Models\Page;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePageTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_pages_page()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAdmin();

        $response = $this->get('/admin/pages');

        $response->assertOk();
    }

    /** @test */
    public function create_page_requires_validation()
    {
        $this->loginAsAdmin();

        Livewire::test(CreatePageForm::class)
            ->call('createPage')
            ->assertHasErrors(['slug']);
    }

    /** @test */
    public function admin_can_create_a_page()
    {
        $this->loginAsAdmin();

        Livewire::test(CreatePageForm::class)
                ->set(['state' => [
                    'title' => 'test page',
                    'slug' => 'test-page',
                    'html' => '<p>this is a test</p>',
                    'layout' => 'layouts.guest',
                    'active' => 1,
                ]])
                ->call('createPage');

        $this->assertDatabaseHas(
            'pages',
            [
                    'title' => 'test page',
                    'slug' => 'test-page',
                    'html' => '<p>this is a test</p>',
                    'layout' => 'layouts.guest',
                    'active' => 1,
                ]
        );

        $this->withoutExceptionHandling();
        $response = $this->get('/pages/'. Page::where('slug', 'test-page')->first()->slug);

        $response->assertOk();
    }
}
