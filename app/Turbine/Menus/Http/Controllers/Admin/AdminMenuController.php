<?php

namespace App\Turbine\Menus\Http\Controllers\Admin;

use App\Turbine\Menus\Models\Menu;
use Illuminate\Http\Request;

class AdminMenuController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $menus = Menu::with('children')->get();

        return view('admin.menus.index', [
            'menus' => $menus,
        ]);
    }
}
