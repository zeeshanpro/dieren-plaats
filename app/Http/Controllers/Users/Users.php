<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function list_user_data(Request $req)
    {
        $data['result']=DB::select('select * from users ');
        $data['result'] = arrayPaginatorWithRequest($data['result'],$req);  
        return view('admin.listusers',$data);
    }
}
