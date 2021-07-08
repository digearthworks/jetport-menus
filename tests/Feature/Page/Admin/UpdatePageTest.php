<?php

namespace Tests\Feature\Page\Admin;

use Livewire;
use Tests\TestCase;
use Turbine\Pages\Http\Livewire\EditPageForm;
use Turbine\Pages\Models\Page;

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
            'html' => '</p>updated html</p>',
        ]);

        Livewire::test(EditPageForm::class, ['resourceId' => $page->id])
            ->set(['state' => [
                'slug' => $page->slug,
                'title' => 'updated title',
                'html' => '</p>updated html</p>',
            ]])
            ->call('updatePage');

        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'title' => 'updated title',
            'html' => '</p>updated html</p>',
        ]);

        $this->withoutExceptionHandling();
        $response = $this->get('/pages/' . $page->fresh()->slug);
        $response->assertOk();
        $response->assertSee('</p>updated html</p>', false);
    }
}
