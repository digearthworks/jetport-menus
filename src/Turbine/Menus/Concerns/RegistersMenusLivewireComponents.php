<?php

namespace Turbine\Menus\Concerns;

use Livewire;
use Turbine\Menus\Http\Livewire\Admin\AdminNavigationMenu;
use Turbine\Menus\Http\Livewire\Admin\AdminSidebarMenu;
use Turbine\Menus\Http\Livewire\Admin\AdminSidebarToggler;
use Turbine\Menus\Http\Livewire\Admin\CreateMenuItemButton;
use Turbine\Menus\Http\Livewire\Admin\CreateMenuItemForm;
use Turbine\Menus\Http\Livewire\Admin\DeactivateMenuItemDialog;
use Turbine\Menus\Http\Livewire\Admin\DeleteMenuItemDialog;
use Turbine\Menus\Http\Livewire\Admin\EditMenuItemForm;
use Turbine\Menus\Http\Livewire\Admin\IconSelect;
use Turbine\Menus\Http\Livewire\Admin\MenuItemsTable;
use Turbine\Menus\Http\Livewire\Admin\ReactivateMenuItemDialog;
use Turbine\Menus\Http\Livewire\Admin\RestoreMenuItemDialog;
use Turbine\Menus\Http\Livewire\DashboardMenu;
use Turbine\Menus\Http\Livewire\MainMenu;

trait RegistersMenusLivewireComponents
{
    public function registerMenusLivewire() : void
    {
        Livewire::component('turbine.menus.admin.menu-items-table', MenuItemsTable::class);
        Livewire::component('turbine.menus.admin.create-menu-item-form', CreateMenuItemForm::class);
        Livewire::component('turbine.menus.admin.edit-menu-item-form', EditMenuItemForm::class);
        Livewire::component('turbine.menus.admin.delete-menu-item-dialog', DeleteMenuItemDialog::class);
        Livewire::component('turbine.menus.admin.deactivate-menu-item-dialog', DeactivateMenuItemDialog::class);
        Livewire::component('turbine.menus.admin.reactivate-menu-item-dialog', ReactivateMenuItemDialog::class);
        Livewire::component('turbine.menus.admin.restore-menu-item-dialog', RestoreMenuItemDialog::class);
        Livewire::component('turbine.menus.admin.create-menu-item-button', CreateMenuItemButton::class);
        Livewire::component('turbine.menus.admin.icon-select', IconSelect::class);

        
        Livewire::component('turbine.menus.admin.admin-navigation-menu', AdminNavigationMenu::class);
        Livewire::component('turbine.menus.admin.admin-sidebar-menu', AdminSidebarMenu::class);
        Livewire::component('turbine.menus.admin.admin-sidebar-toggler', AdminSidebarToggler::class);

        Livewire::component('turbine.menus.dashboard-menu', DashboardMenu::class);
        Livewire::component('turbine.menus.main-menu', MainMenu::class);
    }
}
