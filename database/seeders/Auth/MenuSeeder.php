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
            'icon_id' => '<svg class="h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>',
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
