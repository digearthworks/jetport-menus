<?php

namespace Tests\Feature\Admin\SitePage;

use App\Admin\Livewire\Site\DeleteSitePageDialog;
use App\Pages\Models\SitePage;
use Livewire;
use Tests\TestCase;

class DeleteSitePageTest extends TestCase
{
    /** @test */
    public function a_site_page_can_be_deleted()
    {
        $this->loginAsAdmin();

        $page = SitePage::factory()->create();

        Livewire::test(DeleteSitePageDialog::class)
           ->set('modelId', $page->id)
           ->call('deleteSitePage');

        $this->assertSoftDeleted('site_pages', ['id' => $page->id]);

        $response = $this->get('/pages/' . $page->slug);
        $response->assertStatus(404);
    }
}
