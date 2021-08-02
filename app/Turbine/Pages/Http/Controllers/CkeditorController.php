<?php

namespace App\Turbine\Pages\Http\Controllers;

use Illuminate\Http\Request;

class CkeditorController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->hasFile('upload')) {
            $origin_Name = $request->file('upload')->getClientOriginalName();
            $File_Name = pathinfo($origin_Name, PATHINFO_FILENAME);
            $extension_Name = $request->file('upload')->getClientOriginalExtension();
            $File_Name = $File_Name.'_'.time().'.'.$extension_Name;
        
            $request->file('upload')->move(public_path('images'), $File_Name);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$File_Name);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
