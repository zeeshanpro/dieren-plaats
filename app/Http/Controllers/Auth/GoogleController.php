<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;

class GoogleController extends Controller
{
    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function redirectToGoogle()

    {
        return Socialite::driver('google')->redirect();
    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                if( $finduser->usertype == 'Breeder' or $finduser->usertype == 'Shelter' or $finduser->usertype == 'Normal' ){
                    return redirect()->route('base_url');
                } else {
                    return redirect()->route('showCompleteRegistration');
                }
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('dummypass')
                ]);
                Auth::login($newUser);
                return redirect()->route('showCompleteRegistration');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
