<?php

namespace Tests\Feature\Admin\SitePage;

use App\Http\Livewire\Admin\site\CreateSitePageForm;
use App\Pages\Models\SitePage;
use Livewire;
use Tests\TestCase;

class CreateSitePageTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_site_pages_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/site/pages');

        $response->assertOk();
    }

    /** @test */
    public function create_site_page_requires_validation()
    {
        $this->loginAsAdmin();

        Livewire::test(CreateSitePageForm::class)
            ->call('createSitePage')
            ->assertHasErrors(['slug']);
    }

    /** @test */
    public function admin_can_create_a_site_page()
    {
        $this->loginAsAdmin();

        Livewire::test(CreateSitePageForm::class)
                ->set(['state' => [
                    'title' => 'test page',
                    'slug' => 'test-page',
                    'body' => '<p>this is a test</p>',
                    'layout' => 'layouts.guest',
                    'active' => 1,
                ]])
                ->call('createSitePage');

        $this->assertDatabaseHas(
            'site_pages',
            [
                    'title' => 'test page',
                    'slug' => 'test-page',
                    'body' => '<p>this is a test</p>',
                    'layout' => 'layouts.guest',
                    'active' => 1,
                ]
        );

        $response = $this->get('/pages/'. SitePage::where('slug', 'test-page')->first()->slug);

        $response->assertOk();
    }
}
