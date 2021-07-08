<?php

namespace Tests\Feature\Page\Admin;

use Livewire;
use Tests\TestCase;
use Turbine\Pages\Http\Livewire\DeletePageDialog;
use Turbine\Pages\Models\Page;

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
