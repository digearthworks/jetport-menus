<?php

namespace Database\Seeders\Auth;

use App\Models\Menu;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminHiddenPermissionId = (Permission::where('name', 'admin.access.hidden')->first())->id;

        $menusEditPermissionId = (Permission::where('name', 'admin.access.menus.edit')->first())->id;

        $menusAllPermissionId = (Permission::where('name', 'admin.access.menus')->first())->id;

        $menusIndex = Menu::create([
            'group' => 'admin',
            'label' => 'Menu Index',
            'link' => '/menus/index',
            'type' => 'internal_link',
            'title' => 'Link to Index of All Menus and Links',
            'active' => 1,
            'iframe' => 0,
            'sort' => 0,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'fas fa-info',
            'permission_id' => $menusAllPermissionId,
        ]);

        $menusManager = Menu::create([
            'group' => 'admin',
            'label' => 'Menu Management',
            'link' => '/menus/manage',
            'type' => 'internal_link',
            'title' => 'Link to the Menu Manager',
            'active' => 1,
            'iframe' => 0,
            'sort' => 1,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'far fa-list-alt',
            'permission_id' => $menusEditPermissionId,
        ]);

        $adminDashboard = Menu::create([
            'group' => 'admin',
            'label' => 'Admin Dashboard',
            'link' => '/admin/dashboard',
            'type' => 'internal_link',
            'title' => 'Link to the Admin Dashboard',
            'active' => 1,
            'iframe' => 0,
            'sort' => 2,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'fas fa-tachometer-alt',
            'permission_id' => $adminHiddenPermissionId,
        ]);

        $adminUserManager = Menu::create([
            'group' => 'admin',
            'label' => 'User Management',
            'link' => '/admin/auth/user',
            'type' => 'internal_link',
            'title' => 'Link to the User Manager',
            'active' => 1,
            'iframe' => 0,
            'sort' => 3,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'fas fa-user-cog',
            'permission_id' => $adminHiddenPermissionId,
        ]);

        $adminRoleManager = Menu::create([
            'group' => 'admin',
            'label' => 'Role Management',
            'link' => '/admin/auth/role',
            'type' => 'internal_link',
            'title' => 'Link to the Role Manager',
            'active' => 1,
            'iframe' => 0,
            'sort' => 4,
            'row' => null,
            'menu_id' => null,
            'icon_id' => 'fas fa-paint-roller',
            'permission_id' => $adminHiddenPermissionId,
        ]);
    }
}
