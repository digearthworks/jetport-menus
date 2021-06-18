<?php

namespace Tests\Feature\Admin\Page;

use App\Core\Admin\Livewire\Page\DeletePageDialog;
use App\Core\Pages\Models\Page;
use Livewire;
use Tests\TestCase;

class DeletePageTest extends TestCase
{
    /** @test */
    public function a_page_can_be_deleted()
    {
        $this->loginAsAdmin();

        $page = Page::factory()->create();

        Livewire::test(DeletePageDialog::class)
           ->set('modelId', $page->id)
           ->call('deletePage');

        $this->assertSoftDeleted('pages', ['id' => $page->id]);

        $response = $this->get('/pages/' . $page->slug);
        $response->assertStatus(404);
    }
}
