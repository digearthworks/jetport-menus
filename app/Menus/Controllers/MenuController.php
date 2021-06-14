<?php

namespace App\Menus\Controllers;

use App\Http\Controllers\Controller;
use App\Menus\Models\Menu;

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
