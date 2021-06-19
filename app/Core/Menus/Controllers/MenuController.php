<?php

namespace App\Core\Menus\Controllers;

use App\Core\Menus\Models\Menu;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Menu $menu)
    {
        return view('menus.show', [
            'menu' => $menu,
        ]);
    }
}
