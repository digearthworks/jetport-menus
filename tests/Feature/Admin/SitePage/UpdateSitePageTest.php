<?php

namespace Tests\Feature\Admin\Page;

use App\Admin\Livewire\Page\EditPageForm;
use App\Pages\Models\Page;
use Livewire;
use Tests\TestCase;

class UpdatePageTest extends TestCase
{
    /** @test */
    public function a_page_can_be_updated()
    {
        $this->loginAsAdmin();

        $page = Page::factory()->create();

        $this->assertDatabaseMissing('pages', [
            'id' => $page->id,
            'title' => 'updated title',
            'body' => '</p>updated body</p>',
        ]);

        Livewire::test(EditPageForm::class)
            ->set('modelId', $page->id)
            ->set(['state' => [
                'slug' => $page->slug,
                'title' => 'updated title',
                'body' => '</p>updated body</p>',
            ]])
            ->call('updatePage');

        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'title' => 'updated title',
            'body' => '</p>updated body</p>',
        ]);

        $response = $this->get('/pages/' . $page->fresh()->slug);
        $response->assertOk();
        $response->assertSee('</p>updated body</p>', false);
    }
}
