<?php

namespace Tests\Feature\Page\Admin;

use Livewire;
use Tests\TestCase;
use Turbine\Pages\Http\Livewire\DeletePageTemplateDialog;
use Turbine\Pages\Models\PageTemplate;

class DeleteTemplateTest extends TestCase
{
    /** @test */
    public function a_template_can_be_deleted()
    {
        $this->loginAsAdmin();

        $page = PageTemplate::factory()->create();

        Livewire::test(DeletePageTemplateDialog::class)
           ->set('modelId', $page->id)
           ->call('deletePageTemplate');

        $this->assertSoftDeleted('page_templates', ['id' => $page->id]);
    }
}
