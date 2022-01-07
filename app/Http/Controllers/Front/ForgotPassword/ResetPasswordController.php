<?php

namespace App\Http\Controllers\Front\ForgotPassword;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\User;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function show_reset_password_screen( Request $request, $token ){
        $updatePassword = DB::table('password_resets')
                        ->where('token' ,'=', $token)
                        ->first();
        if($updatePassword){
            return view('front_new.reset', ['token' => $token]);   
        } else {
            return redirect()->route('base_url');
        }
    }

    public function update_forgot_password(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_resets')
                        ->where(['email' => $request->email, 'token' => $request->token])
                        ->first();

        if(!$updatePassword){
            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid details. Please check and try again!']);
        }
            

        $user = User::where('email', $request->email)
                    ->update(['password' => bcrypt($request->password) ]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        Session::flash('message','Your account login details have been updated successfully. Please <a href="'.route('login').'">login</a> to continue');
        return redirect()->back();

    }
}
