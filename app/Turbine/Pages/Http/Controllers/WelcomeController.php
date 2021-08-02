<?php

namespace App\Turbine\Pages\Http\Controllers;

use App\Turbine\Pages\Models\Page;
use Illuminate\Http\Request;

class WelcomeController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (
            config('turbine.pages.redirect_slash_to_welcome') &&
            Page::onlyActive()->where('slug', 'welcome')->count()
        ) {
            return redirect('/welcome');
        }

        return view('welcome');
    }
}
