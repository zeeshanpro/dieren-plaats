<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function generateAccessToken( $user ) {
        $token = $user->createToken( $user->email . '-' . now() );
        return $token->accessToken;
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'email' => '',
            'mobile' => 'required', 
            'password' => 'required|min:6'
        ]);
        
        $user = User::create([
            'name' => $request->name, 
            'mobile' => $request->mobile, 
            'password' => bcrypt($request->password),
            'email'  => $request->email, 
            'is_admin' => 0
        ]);

        return response()->json($user);
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required|exists:users',//email 
            'password' => 'required'
        ]);
        
        $user = User::where('mobile', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken($user->email.'-'.now())->accessToken;
                $response = ['token' => $token];
                return response(['profile' => $user,
                                'token' => $response], 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function mobileOtpVerify( Request $request ){
        $request->validate([
            'mobile' => 'required|exists:users',
            'otp' => 'required'
        ]);
        $user = User::where([
                            ['mobile', '=' , $request->mobile],
                            ['mobile_otp', '=' ,$request->otp]
                        ])->first();
        if ($user) {
            $user->is_mobile_verified = 1;
            $user->save();
            $response = ["message" =>'OTP Verified successfully',
                        'status' => 'success'];
            return response($response, 200);
        } else {
            $response = ["message" =>'Incorrect OTP',
                        'status' => 'error'];
            return response($response, 422);
        }
    }
}
