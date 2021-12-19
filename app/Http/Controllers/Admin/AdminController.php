<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function loginCheck(Request $request)
    {
        $validator =$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $admin = User::where([
                ['email',$request->email],
                ['usertype','Admin'],
            ])->first();
            $request->session()->put('admin', $admin );
            return redirect('/admin/dashboard');
        }
        return redirect("/admin/login")->withSuccess('Login details are not valid');
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        //session()->forget('admin');
        return redirect('/admin/login');
    }
}
