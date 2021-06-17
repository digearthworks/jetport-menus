<?php

namespace Tests\Feature\Admin\Page;

use App\Admin\Livewire\Page\CreatePageForm;
use App\Pages\Models\Page;
use Livewire;
use Tests\TestCase;

class CreatePageTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_pages_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/site/pages');

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
                    'body' => '<p>this is a test</p>',
                    'layout' => 'layouts.guest',
                    'active' => 1,
                ]])
                ->call('createPage');

        $this->assertDatabaseHas(
            'pages',
            [
                    'title' => 'test page',
                    'slug' => 'test-page',
                    'body' => '<p>this is a test</p>',
                    'layout' => 'layouts.guest',
                    'active' => 1,
                ]
        );

        $response = $this->get('/pages/'. Page::where('slug', 'test-page')->first()->slug);

        $response->assertOk();
    }
}
