<?php

namespace App\Http\Controllers\Front\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Front\UserInterface;
use App\Http\Requests\Front\UserRequest;
Use App\Models\User;
use Stripe;
use Session;
use Exception;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function show_forgot_password(){
        return view('front.forgot_password');
    }

    public function send_forgot_password_email(Request $request)
    {   
        
        $validation = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(10);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => date('Y-m-d H:i:s') ]
        );
        $user = User::where( 'email', '=', $request->email )->first();
        $arrayToSend = array( 'customer' => $user->name, 'token' => $token );
        Mail::send( 'mailtemplates.forgot_password' , $arrayToSend, function( $message ) use( $request ) {
        $message->to( $request->email );
        $message->subject( 'Wachtwoord vergeten misschien?' );
        Session::flash('message','Email sent successfully to your email address. Please follow the email for instruction to reset the password.');
        } );

        return redirect()->back();
    }

    

    public function show(){
        // $arrayToSend = array('email'=>'balmeetsachar@gmail.com','otp' => '12345','name' => 'Balmeet Singh Sachar');
        // Mail::send( 'mailtemplates.registerOTPMail' , $arrayToSend, function( $message ) {
        //     $message->to( 'balmeetsachar@gmail.com' );
        //     $message->subject(  config("app.name") . ': OTP Verification ');

        // } );
        return view('front.register');
    }

    public function createUserManually( UserRequest $request ){
        $result = $this->userInterface->createUser( $request );
        if( $result['code'] == 201 ){
            session(['email' => $request->email ]);
            return redirect('emailverify');
        } else {
            return redirect()->back()
                        ->withErrors($result['msg']);
        }   
    }    

    public function showEmailVerification(){
        return view( 'front.emailotp' );
    }

    public function validateEmailVerification( Request $request ){
        $data = $this->userInterface->validateEmailVerification( $request );
        if( $data['code'] == 201 )
        {
            try {
                    //$user = auth()->user();
                    $user = User::with('Breeder')->find(Auth::id());
                    if( $user->usertype != 'Normal' ){
                        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                        if( $user ) {
                            if (is_null($user->stripe_id)) {
                                $options = array('address' => [
                                    'line1' => $user->Breeder->street,
                                    'city' => $user->Breeder->city,
                                    //'state' => 'JV',
                                    'country' => $user->Breeder->country, //'NL',
                                    'postal_code' => $user->Breeder->postal_code
                                ]);
                                $stripeCustomer = $user->createAsStripeCustomer($options);
                            }
                        }
    
                        $checkout_session = \Stripe\Checkout\Session::create([
                            'success_url' => route('base_url') . '/subscription-success?session_id={CHECKOUT_SESSION_ID}', //?session_id={CHECKOUT_SESSION_ID}
                            'cancel_url' => route('base_url') . '/subscription-canceled',
                            'payment_method_types' => ['card','sepa_debit'], //,'ideal' cannot be used for subcription
                            'mode' => 'subscription',
                            'customer' => $user->stripe_id,
                            //'billing_address_collection' => $user->Breeder->street.', '.$user->Breeder->city
                              //                                  .', '.$user->Breeder->postal_code.', '.$user->Breeder->country ,
                            //'customer_email' => $user->email,
                            //'automatic_tax' => ['enabled' => true],
                            'line_items' => [[
                                'price' => $user->stripe_product_id ,//'price_1JxxPNCaEIG4B93yTxn1GsRe',
                                'quantity' => 1,
                            ]]
                        ]);
    
                        return redirect()->to( $checkout_session->url );
                    } else {
                        return redirect()->route('base_url');
                    }                    
            } catch (Exception $e) {
                echo $e->getMessage();
                dd();
                return back()->with('success',$e->getMessage());
            }
            //return redirect( '/subscription-plan' );
        } else if( $data['code'] == 422 ){
            return redirect()->back()
                        ->withErrors($data['msg']);
        }
        return redirect()->back()->withInput($request->input());
    }
}
