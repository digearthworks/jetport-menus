<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class MenuController extends Controller
{
    public function show(Menu $menu)
    {
        return view('menus.show', [
            'menu' => $menu,
        ]);
    }
}
