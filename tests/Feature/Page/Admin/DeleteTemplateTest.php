<?php

namespace Tests\Feature\Page\Admin;

use App\Turbine\Pages\Http\Livewire\DeletePageTemplateDialog;
use App\Turbine\Pages\Models\PageTemplate;
use Livewire\Livewire;
use Tests\TestCase;

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
