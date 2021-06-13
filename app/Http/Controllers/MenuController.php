<?php

namespace App\Http\Controllers;

use App\Models\Menu;

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
