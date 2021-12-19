<?php

namespace App\Http\Controllers\Front\SubsNew;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Models\User;
use Stripe;
use Session;
use Exception;
use Illuminate\Support\Facades\DB;

class SubscriptionNewController extends Controller
{

    public function showform( Request $request ) {
        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

        // if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        //     echo 'Invalid request';
        //     exit;
        // }

        $domain_url = 'https://dieren-plaats.nl';

        // Create new Checkout Session for the order
        // Other optional params include:
        // [billing_address_collection] - to display billing address details on the page
        // [customer] - if you have an existing Stripe Customer ID
        // [payment_intent_data] - lets capture the payment later
        // [customer_email] - lets you prefill the email input in the form
        // [automatic_tax] - to automatically calculate sales tax, VAT and GST in the checkout page
        // For full details see https://stripe.com/docs/api/checkout/sessions/create

        // ?session_id={CHECKOUT_SESSION_ID} means the redirect will have the session ID set as a query param
        $checkout_session = \Stripe\Checkout\Session::create([
            'success_url' => $domain_url . '/subscription-success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $domain_url . '/subscription-canceled',
            'payment_method_types' => ['card','sepa_debit'], //,'ideal' cannot be used for subcription
            'mode' => 'subscription',
            // 'automatic_tax' => ['enabled' => true],
            'line_items' => [[
                'price' => 'price_1JxxPNCaEIG4B93yTxn1GsRe',
                'quantity' => 1,
            ]]
        ]);

        return redirect()->to( $checkout_session->url );
    }

    public function successResponse( Request $request ){
        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

        // Fetch the Checkout Session to display the JSON result on the success page
        $checkout_session_id = $request->session_id;
        $checkout_session = \Stripe\Checkout\Session::retrieve($checkout_session_id);
        if( $checkout_session->status == "complete" ) {
            //echo 'completed successfully';   
            $msg = 'Thank you. You have successfully registered for subscription!!';
        } else {
            $msg = 'Thanks for proceeding with payment. It seems the payment processing is taking a bit time. We will send you an email as soon as the payment goes through!!';
        }
        //dd($checkout_session);
        // Format as JSON for the demo.
        // $session_json = json_encode($checkout_session, JSON_PRETTY_PRINT);
        // dd($session_json);

        return view('front.paymentsuccess', [ 'msg' => $msg ] ) ;
    }

    public function customerPortal( Request $request ){
        \Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET']);

        // For demonstration purposes, we're using the Checkout session to retrieve the customer ID.
        // Typically this is stored alongside the authenticated user in your database.
        $checkout_session = \Stripe\Checkout\Session::retrieve($request->sessionId);
        $stripe_customer_id = $checkout_session->customer;

        // This is the URL to which users are redirected after managing their billing
        // with the customer portal.
        $return_url = 'https://dieren-plaats.nl';

        $session = \Stripe\BillingPortal\Session::create([
        'customer' => $stripe_customer_id,
        'return_url' => $return_url,
        ]);

        return redirect()->to($session->url);
    }

    public function cancelResponse( Request $request ){
        echo 'your payment was cancelled';
        return ;
    }

    public function proceedToChangeUserType( Request $request ){
        
        if( $request->usertypeto != '' and ( $request->usertypeto == 'Normal' 
                or $request->usertypeto == 'Shelter' or $request->usertypeto == 'Breeder' ) ){
               if( $request->usertypeto == 'Normal' ){
                    // cancel the subscription and make sure only 3 latest ads are active and all other are set to not publish
               } else {
                        try {
                            //$user = auth()->user();
                            if( $request->usertypeto == 'Shelter' )
                                $stripe_product_id = STRIPE_SHELTER_PLAN;
                            else 
                                $stripe_product_id = STRIPE_BREEDER_PLAN;

                            $user = User::with('Breeder')->find(Auth::id());
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
                                        'price' => $stripe_product_id ,//'price_1JxxPNCaEIG4B93yTxn1GsRe',
                                        'quantity' => 1,
                                    ]]
                                ]);
            
                                return redirect()->to( $checkout_session->url );                 
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        dd();
                        return back()->with('success',$e->getMessage());
                    }
               }
        } else {
            return redirect()->back()
                            ->withErrors( 'Please choose the correct user type and proceed.' );
        }
    }
}
