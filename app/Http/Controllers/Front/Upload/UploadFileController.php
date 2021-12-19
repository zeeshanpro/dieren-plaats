<?php

namespace App\Http\Controllers\Front\Upload;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UploadFileController extends Controller
{
    public function upload( Request $request ){
        $request->validate([
            'files' => 'required',
            'files.*' => 'required|image|mimes:jpeg,png,jpg|max:5048',
        ]); 
        //dd($request->file());
        //$fileName = uploadImage( $req, 'kindImage', 'uploads/kind', $kindRecord->image );
        $response = uploadImage( $request, 'files[]' , 'uploads/temp' );
        return response()->json(['data'=> $response ]);
    }
}
