<?php

namespace Tests\Feature\Page\Admin;

use Livewire\Livewire;
use Tests\TestCase;
use App\Turbine\Pages\Http\Livewire\CreatePageTemplateForm;

class CreateTemplateTest extends TestCase
{
    /** @test */
    public function an_admin_can_access_the_templates_page()
    {
        $this->withoutExceptionHandling();
        $this->loginAsAdmin();

        $response = $this->get('/admin/pages/templates');

        $response->assertOk();
    }

    /** @test */
    public function create_template_requires_validation()
    {
        $this->loginAsAdmin();

        Livewire::test(CreatePageTemplateForm::class)
            ->call('createPageTemplate')
            ->assertHasErrors(['name']);
    }

    /** @test */
    public function admin_can_create_a_template()
    {
        $this->loginAsAdmin();

        Livewire::test(CreatePageTemplateForm::class)
            ->set(['state' => [
                'name' => 'test page',
                'html' => '<p>this is a test</p>',
                'css' => 'p { color:red; }',
            ]])
            ->call('createPageTemplate');

        $this->assertDatabaseHas(
            'page_templates',
            [
                'name' => 'test page',
                'html' => '<p>this is a test</p>',
                'css' => 'p { color:red; }',
            ]
        );
    }
}
