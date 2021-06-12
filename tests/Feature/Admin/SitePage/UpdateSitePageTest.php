<?php

namespace Tests\Feature\Admin\SitePage;

use App\Http\Livewire\Admin\Site\EditSitePageForm;
use App\Models\SitePage;
use Livewire;
use Tests\TestCase;

class UpdateSitePageTest extends TestCase
{
    /** @test */
    public function a_site_page_can_be_updated()
    {
        $this->loginAsAdmin();

        $page = SitePage::factory()->create();

        $this->assertDatabaseMissing('site_pages', [
            'id' => $page->id,
            'title' => 'updated title',
            'body' => '</p>updated body</p>',
        ]);

        Livewire::test(EditSitePageForm::class)
            ->set('modelId', $page->id)
            ->set(['state' => [
                'slug' => $page->slug,
                'title' => 'updated title',
                'body' => '</p>updated body</p>',
            ]])
            ->call('updateSitePage');

        $this->assertDatabaseHas('site_pages', [
            'id' => $page->id,
            'title' => 'updated title',
            'body' => '</p>updated body</p>',
        ]);

        $response = $this->get('/pages/' . $page->fresh()->slug);
        $response->assertOk();
        $response->assertSee('</p>updated body</p>', false);
    }
}
