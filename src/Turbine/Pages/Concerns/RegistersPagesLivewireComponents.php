<?php

namespace Turbine\Pages\Concerns;

use Livewire;
use Turbine\Pages\Http\Livewire\CreatePageButton;
use Turbine\Pages\Http\Livewire\CreatePageForm;
use Turbine\Pages\Http\Livewire\CreatePageTemplateForm;
use Turbine\Pages\Http\Livewire\DeactivatePageDialog;
use Turbine\Pages\Http\Livewire\DeletePageDialog;
use Turbine\Pages\Http\Livewire\DeletePageTemplateDialog;
use Turbine\Pages\Http\Livewire\EditPageForm;
use Turbine\Pages\Http\Livewire\EditPageTemplateForm;
use Turbine\Pages\Http\Livewire\PagesTable;
use Turbine\Pages\Http\Livewire\PageTemplatesTable;
use Turbine\Pages\Http\Livewire\ReactivatePageDialog;
use Turbine\Pages\Http\Livewire\RestorePageDialog;

trait RegistersPagesLivewireComponents
{
    public function registerPagesLivewire() : void
    {
        Livewire::component('turbine.pages.pages-table', PagesTable::class);
        Livewire::component('turbine.pages.create-page-form', CreatePageForm::class);
        Livewire::component('turbine.pages.edit-page-form', EditPageForm::class);
        Livewire::component('turbine.pages.delete-page-dialog', DeletePageDialog::class);
        Livewire::component('turbine.pages.restore-page-dialog', RestorePageDialog::class);
        Livewire::component('turbine.pages.deactivate-page-dialog', DeactivatePageDialog::class);
        Livewire::component('turbine.pages.reactivate-page-dialog', ReactivatePageDialog::class);
        Livewire::component('turbine.pages.create-page-button', CreatePageButton::class);

        Livewire::component('turbine.pages.delete-page-template-dialog', DeletePageTemplateDialog::class);
        Livewire::component('turbine.pages.create-page-template-form', CreatePageTemplateForm::class);
        Livewire::component('turbine.pages.edit-page-template-form', EditPageTemplateForm::class);
        Livewire::component('turbine.pages.page-templates-table', PageTemplatesTable::class);

    }
}
