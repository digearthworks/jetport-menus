<?php

namespace Turbine\Pages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Turbine\Pages\Models\PageTemplate;

class PageTemplateController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.pages.create-template');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(PageTemplate $template)
    {
        return view('admin.pages.edit-template', ['template' => $template]);
    }
}
