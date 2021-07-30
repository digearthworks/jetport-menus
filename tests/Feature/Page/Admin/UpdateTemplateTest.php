<?php

namespace Tests\Feature\Page\Admin;

use Livewire\Livewire;
use Tests\TestCase;
use App\Turbine\Pages\Http\Livewire\EditPageTemplateForm;
use App\Turbine\Pages\Models\PageTemplate;

class UpdateTemplateTest extends TestCase
{
    /** @test */
    public function a_template_can_be_updated()
    {
        $this->loginAsAdmin();

        $page = PageTemplate::factory()->create();

        $this->assertDatabaseMissing('page_templates', [
            'id' => $page->id,
            'name' => 'updated name',
            'html' => '</p>updated html</p>',
        ]);

        Livewire::test(EditPageTemplateForm::class, ['resourceId' => $page->id])
            ->set(['state' => [
                'name' => 'updated name',
                'html' => '</p>updated html</p>',
            ]])
            ->call('updatePageTemplate');

        $this->assertDatabaseHas('page_templates', [
            'id' => $page->id,
            'name' => 'updated name',
            'html' => '</p>updated html</p>',
        ]);
    }
}
