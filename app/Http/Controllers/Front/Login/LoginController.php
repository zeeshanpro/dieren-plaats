<?php

namespace App\Http\Controllers\Front\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\UserInterface;
use App\Http\Requests\Front\UserRequest;

class LoginController extends Controller
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function showLogin(){
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('front.login');
    }

    public function loginManually( Request $request ){
        $data = $this->userInterface->loginUserManual( $request );
        if( $data['code'] == 201 )
        {
            if( $data['emailverified'] == false ){
                return redirect( '/emailverify' );
            } else {
                if( session()->has('url.intended') ){
                    return redirect(session('url.intended'));
                }
                return redirect( '/' );
            }
            
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data);
        }

        return redirect( '/' );
    }
}
